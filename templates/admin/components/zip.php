<?php 
$root = $_SERVER['DOCUMENT_ROOT']; 	
$fileName = "/autozip.zip";
$outputRoot = $root."".$fileName;


//$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";


switch ( $action ) {
  case 'Zip':
    Zip();
    break;
  case 'rmZip':
	exec("rm $outputRoot");
	echo 'rmzip';
    break;
  case 'mkZip':
	Zip( $root , $outputRoot);
	echo 'zipDir';
	break;
  default:
    echo'Homepage';
}



//Zip Function, called from mkZip
function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();

}


?>


<?php/* echo $fileName; */?>

