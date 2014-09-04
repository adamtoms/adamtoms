<?php include "templates/include/admin/header.php" ?>
<?php include "templates/include/admin/bread.php" ?>

<ul class="homepage-grid">
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=listArticles">
			<i class="icon-popup"></i>
			<h2>Articles</h2>
			<p><a href="/admin.php?action=newArticle">New Article</a>, Edit Article, View Articles</p>
		</a>
	</li>	
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=listCategories">
			<i class="icon-th-large"></i>
			<h2>Categories</h2>
			<p>Organise your content.</p>
		</a>
	</li>
	<li>
		<a href="/admin.php?action=listHomepages">
			<i class="icon-home"></i>
			<h2>Homepages</h2>
			<p>Edit the sites homepages</p>
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
		<a href="<?php DOMAIN; ?>/admin.php?action=logout">
			<i class="icon-lock-open"></i>
			<h2>Log Out</h2>
			<p>LogOut</p>
		</a>
	</li>
</ul>

<code>
	<a href="http://adamtoms.co.uk/?action=viewHomepageName&page_identifier=about">View homepage</a>
	<br>
	<a href="http://adamtoms.co.uk/admin.php?action=newHomepage">new homepage</a>
	<br>
	<a href="http://adamtoms.co.uk/admin.php?action=editHomepage&homepageId=1">edit homepage</a>
	<br>
	<a href="admin.php?action=deleteHomepage&amp;homepageId=1">remove homepage</a>
	<br>
	<a href="admin.php?action=listHomepages">List Homepages</a>
	<br>I should beable to echo a list of all homepage names, much like i did with the categories. this could then be used to populate the menu? not best soloution.
</code>

<?php include "templates/include/admin/footer.php" ?>