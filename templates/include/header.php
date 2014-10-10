<?php /* $s = microtime(true); */ ?>
<!DOCTYPE html>
<html>
<head>	
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1"/> <!-- was 9 -->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="keywords" content="<?php globalSetting("keywords")?>" />
	<meta name="description" content="<?php echo htmlspecialchars( $results['article']->summary ); echo htmlspecialchars( $results['homepages']->summary );echo $results['homepageDescription']->content;?>" />
	<link rel="dns-prefetch" href="<?php globalSetting("domain")?>">
<!--	<link rel="stylesheet" type="text/css" media="screen, print" href="/templates/include/css/compress.php" /> -->
	<link rel="stylesheet" type="text/css" media="screen, print" href="/templates/include/css/writerOutput.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<title><?php echo htmlspecialchars( $results['pageTitle'] );?></title>
	<script>document.cookie = "device_dimensions=" + screen.width + "x" + screen.height + "; path=/";</script>
</head>
<?php flush(); ?>
<body>
	<main class="Site-content">
	<?php require "menu.php" ?>
	<!-- add to homepage as value. Adam Toms - Photography, Kiting and Web Development -->