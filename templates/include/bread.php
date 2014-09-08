<h1><?php echo $results['pageTitle'] ?></h1>

<div id="breadcrumb">
	<p>
		<a href="/admin.php">Home</a>
		- 
		<a 
		href="<?php DOMAIN;?>/<?php echo htmlspecialchars( $results['category']->name )?>"
		title="<?php echo htmlspecialchars( $results['category']->description )?>"
		>
			<?php echo htmlspecialchars( $results['category']->name )."-"?>
			<?php echo $results['adminBread'] ."-"?>
		</a>
		 
		<?php echo htmlspecialchars( $results['pageTitle'] )?>
	</p>
</div>
