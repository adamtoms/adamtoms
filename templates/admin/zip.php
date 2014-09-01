<?php include "templates/include/admin/header.php" ?>
<?php include "templates/include/admin/bread.php" ?>
<style>
	
	

		#ZipButton, #rmZipButton {float:none; margin: 0px 5%;} 
		#ZipFiles,#rmZip{width: 200px;height: 50px;font-size: 20px;position:relative;margin:2.5% 0;}
		#zipDownloadText{font-size: 2em;width:100%;margin:5% 0;display: block;text-align: center;}

	@media screen and (min-width: 641px) { 
		#ZipButton, #rmZipButton {float: left;width: 40%;}
	}
	
</style>
<?php 
$root = $_SERVER['DOCUMENT_ROOT']; 	
$fileName = "/autozip.zip";
$outputRoot = $root."".$fileName;
?>

<div class="statusMessage2" id="zipRemoved" style="display: none;">Zip has been removed.</div>

	<ul class="mcontent">
		<li style="text-align: center;">
		
			<div id="ZipButton">
				<button type="button" id="ZipFiles">Download Zip</button>
			</div>
			
			<code id="zipDownloadText"> 
				<a href="<?php echo $fileName; ?>" style="display: none;" id="ZipDownload">download here...</a>
			</code>

			<div id="rmZipButton">
				<button type="button" id="rmZip">Remove Zip	</button>
			</div>	
			
		</li>
		<li>
			<!--<p>To remove the Zip</p>
			<ul>
				<li>realpath — Returns canonicalized absolute pathname</li>
    			<li>is_readable — Tells whether a file exists and is readable</li>
    			<li>unlink — Deletes a file</li>
    		</ul>
			<p>Run your filepath through realpath, then check if the returned path exists and if so, unlink it.</p> -->
		</li>
	</ul>
	
<?php include "templates/include/admin/footer.php" ?>