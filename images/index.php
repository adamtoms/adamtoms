<?php

  $device_width = 0;
  $device_height = 0;
  $file = $_SERVER['QUERY_STRING'];

  if (file_exists($file)) {

    // Read the device viewport dimensions
    if (isset($_COOKIE['device_dimensions'])) {
      $dimensions = explode('x', $_COOKIE['device_dimensions']);
      if (count($dimensions)==2) {
        $device_width = intval($dimensions[0]);
        $device_height = intval($dimensions[1]);
      }
    }

    if ($device_width > 0) {

      $fileext = pathinfo($file, PATHINFO_EXTENSION);

      // Low resolution image
      if ($device_width <= 640) {
        $output_file = substr_replace($file, '-low', -strlen($fileext)-1, 0);
      } 

      // Medium resolution image
      else if ($device_width <= 900) {
        $output_file = substr_replace($file, '-med', -strlen($fileext)-1, 0);
      }

      // check the file exists
      if (isset($output_file) && file_exists($output_file)) {
        $file = $output_file;
      }
    }

    // return the file;
    readfile($file);
  }

?>
 
<?php 
echo $file;
echo $device_width;
echo $device_height;

    if (isset($_COOKIE['device_dimensions'])) {
      $dimensions = explode('x', $_COOKIE['device_dimensions']);
      if (count($dimensions)==2) {
        $device_width = intval($dimensions[0]);
        $device_height = intval($dimensions[1]);
      }
    }


?>
<?php echo '

<div style="margin:10%;">
	<code style="font-size:3em;width:90%;">
		img.ext<br>
		img-low.ext<br>
		img-med.ext<br>
		<br>
		device width, low <=640<br>
		device width, med <=900<br>
		<br>
		cookie = "device_dimensions"<br>
	</code>
</div>



'
?>