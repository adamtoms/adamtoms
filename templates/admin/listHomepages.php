<?php include "templates/include/admin/header.php" ?>
<?php include "templates/include/admin/bread.php" ?>

<ul class="homepage-grid">
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=newHomepage">
			<i class="icon-plus-circle"></i>
			<h2>New Homepage</h2>
			<p>Create a new Homepage.</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/?action=archive">
			<i class="icon-archive"></i>
			<h2>Archive</h2>
			<p>View all published articles</p>
		</a>
	</li>
</ul>
	
  <ul class="mcontent">
 	<li>
      <table>
        <tr>
          <th>Name</th>
          <th>Publication Date</th>
          <th>Category</th>
        </tr>
 
<?php foreach ( $results['homepages'] as $homepage ) { ?>
 
        <tr onclick="location='admin.php?action=editHomepage&amp;homepageId=<?php echo $homepage->id?>'">
          <td>
            <?php echo $homepage->title?>
          </td>          
          <td><?php echo date('j M Y', $homepage->publicationDate)?></td>
           <td>
            <?php echo $results['categories'][$homepage->categoryId]->name?>
          </td>
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="admin.php?action=newHomepage">Add a new Homepage</a></p>
</li>
</ul>
<?php include "templates/include/admin/footer.php" ?>