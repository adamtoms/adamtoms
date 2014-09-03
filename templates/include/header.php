<!DOCTYPE html>
<html>
<head>
	<link href="../templates/include/css/base.css" rel="stylesheet" type="text/css"/>
	<link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link type="text/css" rel="stylesheet" href="../templates/include/css/fontello.css">
	<title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="keywords" content="Adam,toms,kite,photography,responsive,music,wed,development,jquery" />
	<meta name="description" content="Adam Toms - Photography, Kiting and Web Development" />
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1"/> <!-- was 9 -->
	<script>document.cookie = "device_dimensions=" + screen.width + "x" + screen.height + "; Domain=<?php echo DOMAIN;?>"; </script>
	<!-- <script>document.cookie = "device_dimensions=" + screen.width + "x" + screen.height;</script> http://blog.keithclark.co.uk/responsive-images-using-cookies/ -->
</head>
<?php flush(); ?>
<body>
	<main class="Site-content">
	<?php require "menu.php" ?>