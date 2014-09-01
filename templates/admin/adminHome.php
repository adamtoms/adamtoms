<?php include "templates/include/admin/header.php" ?>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
<h1>Home</h1>

<ul class="homepage-grid">
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=newArticle">
			<i class="icon-plus-circle"></i>
			<h2>New Article</h2>
			<p>Create a new page.</p>
		</a>
	</li>
	<li>
		<a href="/admin.php?action=usersHome">
			<i class="icon-users"></i>
			<h2>Users</h2>
			<p>Manage Users</p>
		</a>
	</li>
	<li>
		<a href="/admin.php?action=siteSettings">
			<i class="icon-cog-alt"></i>
			<h2>Tools</h2>
			<p>General Settings and tools</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/admin?action=listArticles">
			<i class="icon-popup"></i>
			<h2>View Articles</h2>
			<p>Lists all articles</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/?action=archive">
			<i class="icon-archive"></i>
			<h2>Archive</h2>
			<p>View all published articles</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN: ?>/admin.php?action=logout">
			<i class="icon-lock-open"></i>
			<h2>Log Out</h2>
			<p>LogOut</p>
		</a>
	</li>
</ul>

<code style="margin: 0 5%; width: 90%;">
	<a href="/admin.php?action=listCategories">List Categorys</a>
	<a href="/admin.php?action=editCategory&categoryId=1">Edit Categorys</a>
	<a href="http://adamtoms.co.uk/?action=archive&categoryId=2">View all articled in catagory</a>
	image upload,<br> search?<br>email me<br>set pageidentifeir in theartice creation.
	</code>

<?php include "templates/include/admin/footer.php" ?>