<?php
/*
windguru.inc.php 
VERSION 1.7 [2010-09-03]

Author: Vaclav Hornik <vhornik@seznam.cz>   

################################################################################
###########  DO NOT EDIT THIS FILE WITHOUT ASKING FOR PERMISSION!!! ############ 
###########           (edit 'windguru.config.php' only)             ############
################################################################################

SEE 'README.txt' FOR INSTALLATION / UPGRADING INSTRUCTIONS!

NOTE THAT IT IS REQUIRED TO REGISTER AND SET UP THE FORECASTS ON WINDGURU.CZ 
BEFORE USING THIS SCRIPT

YOU CAN USE THIS ONLY IF YOU AGREE TO THE RULES SPECIFIED ON WINDGURU.CZ

================================================================================
EXAMPLE USAGE:

require_once('windguru.inc.php');  // this will load the necessary classes

// then include the forecasts using windguru_forecast() function 
// (you get the right codes from your windguru settings page)

windguru_forecast(100,'SOME_CODE'); // includes your forecast for spot id=100 (in default language)
windguru_forecast(999,'OTHER_CODE'); // includes your forecast for spot id=999 (in default language)

// you can also set language of the forecast
// possible languages: see http://www.windguru.cz/int/help_index.php?sec=distr 
// default language can be set in the configuration, if not set default is 'en' = english

windguru_forecast(100,'SOME_CODE','cz'); // includes your forecast for spot id=100 in czech  
	
...

================================================================================

*/

require_once('windguru.config.php');



if (!function_exists('WG_config')) { // this is required in order to work with older windguru.config.php files
	function WG_config() {	global $WG_config;	return $WG_config;	}
}

/*
this is the function clients will use
*/
function windguru_forecast($id_spot,$code,$lang="") {
	$wgf = new WindguruFcst($id_spot,$code,$lang);
	echo $wgf->getHtml();
}

function windguru_forecast_cachetest() {
	// test whether the cache works fine
	echo "<p><b>YOU SHOULD SEE FORECAST FOR TARIFA SPAIN HERE:</b></p> ";
	$wgf = new WindguruFcst(43,'ad53f7d7f4'); // we try Tarifa forecast for user id=1
	$wgf->config['id_user'] = 1; // we want user ID = 1 for thistest
	// let's try to show the Tarifa forecast:
	echo $wgf->getHtml();
	// let's see if the cache worked
	$ok = $wgf->readCache();
	$ech = "<p><b>WINDGURU FORECAST CACHE TEST: ";
	if($ok) $ech .= "<font color='green' size='5'>OK!<br/><br/>CONGRATULATIONS! YOU ARE READY TO GO!</font>";
	else $ech .= "<font color='red' size='5'>FAILED!<br/><br/>PLEASE CHECK YOUR CONFIGURATION</font>";
	$ech .= "</b></p>";
	echo $ech;
}

class WindguruFcst {
	
	var $config, $id_spot, $code, $id_model, $db, $status, $html, $data, $lang, $version, $encoding;
	
	function WindguruFcst($id_spot,$code,$lang='') {
		$this->config = WG_config(); 
		$this->id_spot = (int)$id_spot;
		$this->code = $code;
		$this->id_model = 3;
		$this->db = false;
		if($this->config['cache_type']!='file') $this->dbConnect(); // makes DB connection
		$this->status = array(10 => "", 3 => "");
		$this->last_status_check = 0;
		$this->readStatus(); // read local data status
		$this->html = "";
		$this->data = array(10 => "", 3 => "");
		$this->lang = 'en';
		$this->setLang($lang);
		$this->encoding = "";
		if(isset($this->config['encoding'])) $this->encoding = strtoupper(trim($this->config['encoding']));
 		$this->version = "1.7";
	}
	
	/*
	returns the forecast if available
	takes care of updating from windguru.cz, caching the forecast, reading data status from windguru.cz etc...
	*/
	function getHtml() { 
		if(!$this->id_spot || !$this->code) return $this->errorStr("WRONG PARAMETERS!");
		if(!$this->config['id_user']) return $this->errorStr("MISSING id_user IN CONFIG!");
		$this->updateStatus(); // try to update data status from windguru.cz when it's time
		$ok = $this->readCache(); // read cache for this spot
		$update_cache = false;		
		if(!$this->html) $update_cache = true;
		if($this->data[$this->id_model] && $this->data[$this->id_model]!=$this->status[$this->id_model]) $update_cache = true;
		if($this->data[10] && $this->data[10]!=$this->status[10]) $update_cache = true;
		if($update_cache) $this->updateCache(); // if cache is empty for this spot or it is outdated update from windguru.cz

		$update_status = false;		
		if(!$this->html) $update_status = true;
		if($this->data[$this->id_model] && $this->status[$this->id_model]) {
			if(strtotime($this->data[$this->id_model]) > strtotime($this->status[$this->id_model])) $update_status = true;
		}
		if($this->data[10] && $this->status[10]) {
			if(strtotime($this->data[10]) > strtotime($this->status[10])) $update_status = true;
		}
		if($update_status) $this->updateStatus(1); // if downloaded forecast has newer data than known data status, update data status right now

		if(!$this->html) return $this->errorStr("ERROR. NO DATA...");
		else {
			return $this->html;
		}
	}
	
	function cacheReady($echoerr=1) { // checks if cache is available
		$ok = false;
		if($this->config['cache_type']=='file') {
			if(is_readable($this->fileCacheDir()) && is_writable($this->fileCacheDir())) $ok = true;
		}
		elseif($this->config['cache_type']=='mysql' || $this->config['cache_type']=='postgresql') {
			 if($this->db) $ok = true;
		}
		if($echoerr && !$ok) $this->errorStr('CACHE NOT AVAILABLE!');
		return $ok;
	}
	
	function readCache() { // reads data from cache
		$return = false;
		if(!$this->cacheReady()) return false;
		if(!$this->id_spot) return false;
		if($this->useFileCache()) {
			if(!file_exists($this->fileCacheFilename())) return false; 
			$fcst = @file($this->fileCacheFilename());
			if(!is_array($fcst)) return false;
			if(count($fcst)) $return = true; // read was succesful
			$this->html = implode("",$fcst);
			end($fcst);
			$last = trim(prev($fcst));
			$last = substr($last,10,-3);
			if($last) {
				$tmp = explode(",",$last);
				foreach($tmp as $row) {
					$arr = explode(";",$row);
					$this->data[$this->idMod($arr[0])] = substr($arr[1],0,4)."-".substr($arr[1],4,2)."-".substr($arr[1],6,2)." ".substr($arr[1],8,2).":00:00";
				}
			}
		}
		else {
			$r = $this->db->selectRow($sel = "SELECT met, wave, data FROM wg_data_cache WHERE id_spot = $this->id_spot AND id_model = $this->id_model AND lang = '$this->lang'");
			if($r) {
				if($r['data']) {
					$this->html = $r['data'];
					$this->data[$this->id_model] = $r['met'];
					$this->data[10] = $r['wave'];
					$return = true; // read was succesful
				}
			}
		}
		return $return;
	}
	
	function idMod($str) { // get model id
		$str = strtolower($str);
		if($str=='gfs') return 3;
		if($str=='nww3') return 10;
		return 0;
	}
	
	function updateCache() { // writes data to cache
		$return = false;
		if(!$this->cacheReady()) return false;
		if(!$this->id_spot) return false;
		$this->getForecast();
		if(!$this->data[$this->id_model]) return false;
		if($this->useFileCache()) {
			$return = $this->writeFile($this->fileCacheFilename(),$this->html);
		}
		else {
			$ok = $this->db->query($sel = "DELETE FROM wg_data_cache WHERE id_spot = $this->id_spot AND id_model = $this->id_model AND lang = '$this->lang'");
			$ins_met = $this->data[$this->id_model] ? "'".$this->data[$this->id_model]."'" : 'NULL';
			$ins_wave = $this->data[10] ? "'".$this->data[10]."'" : 'NULL';
			if($ok) $return = $this->db->query($sel = "INSERT INTO wg_data_cache (id_spot, id_model, lang, data, met, wave) VALUES ($this->id_spot, $this->id_model, '$this->lang', '".addslashes($this->html)."', $ins_met, $ins_wave)");
		}
		return $return;
	}

	function readStatus() { // reads local data status
		$return = false;
		if(!$this->cacheReady()) return false;
		$this->status = array();
		if($this->useFileCache()) { // FILE
			if(file_exists($this->fileStatusFilename())) {
				$st = @file($this->fileStatusFilename());
				if(!is_array($st)) return false;
				if(!count($st)) return false;
				foreach($st as $row) {
					$tmp = explode(";",trim($row));
					$this->status[$tmp[0]] = trim($tmp[2]);
				}
			}
			if(!count($this->status)) return false;
		}
		else { // DB
			$status = $this->db->selectRows("SELECT * FROM wg_data_status");
			foreach($status as $tmp) {
				$this->status[(int)$tmp['id']] = $tmp['val'];
			}
		}
		$this->last_status_check = $this->status[0];

		if(count($this->status)) $return = true; // read was succesful
		return $return;
	}

	function updateStatus($reload = 0) { // updates data status from windguru.cz, if reload==1 then it updates immediatelly otherwise it will not update if last update was less then 10 minutes ago
		$return = false;
		if(!$this->cacheReady()) return false;
		if(!$this->last_status_check) $this->readStatus();
		$delay = 10 * 60; // 10 minutes
		if(!$reload) {
			if((time() - $this->last_status_check) < $delay) return true; // if we checked recently do not check again
		}
		$status = $this->getDataStatus();
		if(!count($status)) return false;
		$this->status = array(); 
		$this->status[3] = $status['gfs'];
		$this->status[10] = $status['nww3'];
		if($this->useFileCache()) { // FILE
			$write = "";
			foreach($this->status as $key => $val) $write .= "$key;".substr(strtr($val,":- ",""),0,10).";$val\n";
			$write .= "0;;".time()."\n";
			$return = $this->writeFile($this->fileStatusFilename(),$write);
		}
		else { // DB
			$return = $this->db->query($sel = "UPDATE wg_data_status SET val = '".$this->status[3]."' WHERE id = 3");
			if($return) $ret = $this->db->query("UPDATE wg_data_status SET val = '".$this->status[10]."' WHERE id = 10");
			if($return) $ret = $this->db->query("UPDATE wg_data_status SET val = '".time()."' WHERE id = 0");
		}
		return $return;
	}
	
	function getDataStatus($url = "http://www.windguru.cz/data_status.php") { // reads data status from windguru.cz
		$str =  $this->downloadString($url);
		if(!$str) return false;
		$arr = $this->dStringArr($str);
		$status = array();
		if(!is_array($arr)) return $status;
		if(!count($arr)) return $status;
		foreach($arr as $row) {
			$tmp = explode(";",trim($row));
			if(count($tmp)==3) { if($tmp[0]) $status[$tmp[0]] = trim($tmp[2]); }
		}
		return $status;
	}

	function getForecast($lang="") { // reads data from windguru.cz
		$url = "http://www.windguru.cz/int/distr2.php?u=".$this->config['id_user']."&s=$this->id_spot&c=$this->code&lng=$this->lang&v=".urlencode($this->version)."&enc=$this->encoding";
		$fcsts =  $this->downloadString($url);
		if(!$fcsts) return false;
		$fcst = $this->dStringArr($fcsts);
		if(!is_array($fcst)) return false;
		end($fcst);
		$last = trim(prev($fcst));
		if(substr($last,0,9)!='<!--MDATA') return false;
		$last = substr($last,10,-3);
		if($last) {
			$tmp = explode(",",$last);
			foreach($tmp as $row) {
				$arr = explode(";",$row);
				if(count($arr)==2) $this->data[$this->idMod($arr[0])] = substr($arr[1],0,4)."-".substr($arr[1],4,2)."-".substr($arr[1],6,2)." ".substr($arr[1],8,2).":00:00";
			}
		}
		else {
			return false;
		}
		$this->html = $fcsts;
		if($this->html) return true; // reading was succesful
	}
	
	function downloadString($url) {
		if($this->config['download_method']=='fopen') {
			$c = @file($url);
			if(!is_array($c)) return false;
			else return implode("",$c);
		}
		elseif($this->config['download_method']=='curl') {
			return $this->curlDownload($url);
		}
		else {
			die('wrong configuration! $WG_config[\'download_method\'] must be set to \'fopen\' or \'curl\'');
		}
	}
	
	function dStringArr($str) {
		return explode("\n",$str);
	}

	function curlDownload($url) {
		$ch = curl_init($url);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		$c = curl_exec($ch);
		curl_close($ch);
		if($c) return $c;
		else return false;
	}

	function dbConnect() {
		if($this->db) return;
		if($this->config['cache_type'] == 'mysql') {
			$this->db = new WindguruMysql($this->config['cache_mysql_host'], $this->config['cache_mysql_port'], $this->config['cache_mysql_user'], $this->config['cache_mysql_password'], $this->config['cache_mysql_dbname']);
		}
		elseif($this->config['cache_type'] == 'postgresql') {
			$this->db = new WindguruPgsql($this->config['cache_postgresql_host'],$this->config['cache_postgresql_port'],$this->config['cache_postgresql_user'],$this->config['cache_postgresql_password'],$this->config['cache_postgresql_dbname']);
		}
	}	
	
	function useFileCache() {
		if($this->config['cache_type']=='file') return true;
		else return false;
	}
	
	function fileCacheDir() {
		$ret = trim($this->config['cache_dir']);
		if(!$ret) return $ret;
		elseif($ret=='/') return $ret;
		elseif(substr($ret,-1)=='/') return $ret;
		else return $ret.'/';
	}
	
	function fileStatusFilename() {
		return $this->fileCacheDir()."data_status_local.txt";
	}

	function fileCacheFilename() {
		return $this->fileCacheDir().$this->id_spot."_".$this->id_model."_".$this->code."_".$this->lang.".htm";
	}
	
	function setLang($lang="") {
		if($lang) $this->lang = $lang;
		elseif($this->config['lang']) $this->lang = $this->config['lang'];
		else $this->lang = 'en';
	}
	
	function writeFile($filename,$content) {
		$fp = @fopen ($filename, "w");
        $ok = @fwrite($fp,$content); 
        @fclose($fp);
        return $ok;
	}

	function errorStr($str) { // prints error message in red color
		return "<p><b><font color='red' size='4'>$str</font></b></p>";
	}
	
}

class WindguruDB {

	function WindguruDB() {
		$this->config = WG_config(); 
		$this->connection = false;
	}

    function selectRow($sel) {
        $arr = $this->selectRows($sel);
        if(count($arr)) return $arr[0]; else return array();
    }

}

class WindguruMysql extends WindguruDB {
	
	function WindguruMysql($host,$port,$user,$password,$db) {
		$this->WindguruDB();
		$this->dbConnect($host,$port,$user,$password,$db);
	}

	function dbConnect($host,$port,$user,$password,$db) {
		if($this->connection) return;
		$this->connection = @MySQL_Connect($host.($port ? ":$port" : ""),$user,$password);
		if(!$this->connection) echo "MYSQL CONNECTION FAILED!<br>";
		if($this->connection) {
			$ok = @MySQL_Select_DB($db);
			if(!$ok) $this->error();		
		}
	}
	
	function query($q) {
		if(!$this->connection) {
			$this->error();
			return;
		}
		if($ret = @mysql_query($q, $this->connection)) {
			return $ret;
		}
		else {
			$this->error();
			return false;
		}
	}

    function selectRows($sel) {
        $res = $this->query($sel);
        if(!$res) return array();
        $d = array();
        $cnt = @mysql_num_rows($res);
        for ($i = 0; $i < $cnt; $i++) {
            $d[] = @mysql_fetch_array($res,MYSQL_ASSOC); 
        }
        return $d;
    }
    
    function error() {
		$error = @mysql_error();
    	//echo "$error<br>";
    }
	
}

class WindguruPgsql extends WindguruDB {

	function WindguruPgsql($host,$port,$user,$password,$db) {
		$this->WindguruDB();
		$this->dbConnect($host,$port,$user,$password,$db);
	}

	function dbConnect($host,$port,$user,$password,$db) {
		if($this->connection) return;
		$con = "";
    	if($host) $con .= " host=$host";
    	if($port) $con .= " port=$port"; 
   		$con .= " dbname=$db";
    	$con .= " user=$user";
    	if($password) $con .= "password=$password";
		$this->connection = @pg_connect("$con");
		if(!$this->connection) echo "POSTGRESQL CONNECTION FAILED!<br>";
	}	

	function query($q) {
		if(!$this->connection) {
			$this->error();
			return;
		}
		if($ret = @pg_exec($this->connection,$q)) {
			return $ret;
		}
		else {
			$this->error();
			return false;
		}
	}
	
    function selectRows($sel) {
        $res = $this->query($sel);
        if(!$res) return array();
        $cnt = @pg_numrows($res);
        $d = array();
        for ($i = 0; $i < $cnt; $i++) {
            $d[] = @pg_fetch_array($res,$i,PGSQL_ASSOC); 
        }
        return $d;
    }

    function error() {
    	if(!$this->connection) {
    		//echo "NO POSTGRESQL CONNECTION<br>";
    		return;
    	}
    	$error = pg_errormessage();
    	//echo "$error<br>";
    }
}

?>