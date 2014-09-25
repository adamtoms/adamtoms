<!DOCTYPE html>
<html>
<head>	
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1"/> <!-- was 9 -->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="keywords" content="Adam,toms,kite,photography,responsive,music,wed,development,jquery" />
	<meta name="description" content="<?php echo htmlspecialchars( $results['article']->summary )?><?php echo htmlspecialchars( $results['homepages']->summary )?>" />	
	<link rel="dns-prefetch" href="//adamtoms.co.uk/">
<!-- merge css--><link rel="stylesheet" type="text/css" media="screen, print, projection" href="/templates/include/css/compress.php" />

<!-- old css <link href="<?php /*echo DOMAIN;*/ ?>:8080/templates/include/css/base.css" rel="stylesheet" type="text/css"/> -->
<!-- old css<link type="text/css" rel="stylesheet" href="<?php /*echo DOMAIN; */?>/templates/include/css/fontello.css"> -->

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

	<title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>

	<script>document.cookie = "device_dimensions=" + screen.width + "x" + screen.height + "; path=/";</script>
	<!-- http://blog.keithclark.co.uk/responsive-images-using-cookies/ -->
</head>
<?php flush(); ?>
<body>
	<main class="Site-content">
	<?php require "menu.php" ?>
	<!-- add to homepage as value. Adam Toms - Photography, Kiting and Web Development -->