<!DOCTYPE html>
<html>
<head>
<title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="keywords" content="Adam,toms,kite,photography,responsive,music,wed,development,jquery" />
<meta name="description" content="Admin Utility, built by Adam Toms" />
<meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1" /> <!-- dougs soloution  -->	

<link href="<?php DOMAIN; ?>/templates/include/admin/fontello.css" rel="stylesheet" type="text/css"/>
<link href="<?php DOMAIN; ?>/templates/include/admin/admin.css" rel="stylesheet" type="text/css"/> 
<link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>	
<script>document.cookie = "device_dimensions=" + screen.width + "x" + screen.height;</script>

</head>
<body class="Site">
	<main class="Site-content"><!--remove/d div! -->

	<?php require "menu.php" ?>