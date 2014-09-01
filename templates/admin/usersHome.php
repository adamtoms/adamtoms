<?php include "templates/include/admin/header.php" ?>
<?php include'templates/include/admin/bread.php';?>



<!-- set status message. this can be created as a function and called in the header on admin pages-->
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>



<ul class="mcontent">
	<li>
    	<table>
        	<tr>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Level</th>
				<th>ID</th>
			</tr>
			
			<?php foreach ( $results['users'] as $users ) { ?>
				<tr onclick="location='admin.php?action=editUser&amp;id=<?php echo $users->id?>'"><!--?action=editArticle&amp;articleId-->
					<td><?php echo $users->username?></td>
					<td><?php echo $users->name?></td>
					<td><?php echo $users->email?></td>
					<td><?php echo $users->level?></td>
					<td><?php echo $users->id?></td>
				</tr>
<?php } ?>
		</table>
		<?php echo $users->list?>
 
		<p><?php echo $results['totalRows']?> user<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>

<ul class="homepage-grid">
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=newUser">
			<i class="icon-plus-circle"></i>
			<h2>New User</h2>
			<p>Create a new user.</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/admin?action=listArticles">
			<i class="icon-popup"></i>
			<h2>Remove user</h2>
			<p>jquery delete box appear?</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/?action=archive">
			<i class="icon-archive"></i>
			<h2>Mail</h2>
			<p>mass mail?</p>
		</a>
	</li>
</ul>
<?php include "templates/include/admin/footer.php" ?>