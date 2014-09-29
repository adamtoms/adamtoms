<?php include "templates/include/admin/header.php" ?>
<?php include "templates/include/admin/bread.php" ?>

  <ul class="mcontent">
 	<li>
      <table>
        <tr>
          <th>Name</th>
          <th>Content</th>
          <th>Notes</th>
        </tr>
 
<?php foreach ( $results['globalSettings'] as $globalSetting ) { ?>
        <tr onclick="location='admin.php?action=editGlobalSettings&amp;settingId=<?php echo $globalSetting->id?>'">
			<td><?php echo $globalSetting->name?></td>
			<td><?php echo $globalSetting->content?></td>
			<td><?php echo $globalSetting->notes?></td>
        </tr>
<?php } ?>
      </table>
      
      <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="admin.php?action=newArticle">Add a new Global Setting</a></p>
</li>
</ul>


<ul class="homepage-grid">
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=newArticle">
			<i class="icon-plus-circle"></i>
			<h2>New Article</h2>
			<p>Create a new page.</p>
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


<?php include "templates/include/admin/footer.php" ?>
