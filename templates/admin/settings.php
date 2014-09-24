<?php include "templates/include/admin/header.php" ?>
<?php include'templates/include/admin/bread.php';?>


<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>


<ul class="homepage-grid">
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=newArticle">
			<i class="icon-globe"></i>
			<h2>Domain</h2>
			<p>Manage Site Domain</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/admin?action=listArticles">
			<i class="icon-signal"></i>
			<h2>Admin Details</h2>
			<p>Manage administrator details</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=zipSite">
			<i class="icon-download-cloud"></i>
			<h2>Zip</h2>
			<p>Zips the home Dir</p>
		</a>
	</li>
	<li>
		<a href="/admin.php?action=menuHome">
			<i class="icon-stackoverflow"></i>
			<h2>Main Menu</h2>
			<p>Edit the frontpage menu</p>
		</a>
	</li>
	<li>
		<a href="#">
			<i class="icon-list"></i>
			<h2>APIs</h2>
			<p>Manage API Feeds</p>
		</a>
	</li>
	<li>
		<a href="#">
			<i class="icon-css"></i>
			<h2>StyleSheet</h2>
			<p>Upload and set stylesheet</p>
		</a>
	</li>
</ul> 
<?php include "templates/include/admin/footer.php" ?>