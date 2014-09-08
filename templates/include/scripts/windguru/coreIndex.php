<head><link rel="stylesheet" href="adamtoms.co.uk/templates/include/scripts/windguru/wg_images/wgstyle.css" type="text/css">

<style>
	.wgfcst table.forecast {
font-size: 11px;
font-family: 'Arial CE', 'Helvetica CE', Arial, Helvetica, sans-serif;
margin: 0px 0px 0px 0px;
text-align: center;
}
.wgfcst table.forecast-ram {
background-color: transparent;
border: 1px solid #666666;
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
}
.wgfcst a:link {
color: #000099;
}
.wgfcst a:visited{
color: #000099;
}


</style>
</head>
<?php
 
require_once('windguru.inc.php');  // this will load the necessary classes


windguru_forecast(47924,'9fccd6a85f'); // includes your forecast for spot id=100 

//find how the iamges are called and change the paths to root relative
 
 ?>