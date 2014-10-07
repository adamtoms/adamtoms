<?php include "templates/include/admin/header.php" ?>
<?php include "templates/include/admin/bread.php" ?>

 <ul class="mcontent">
 	<li>
      <table>
        <tr>
          <th>Category</th>
        </tr>
 
<?php foreach ( $results['categories'] as $category ) { ?>
 
        <tr onclick="location='admin.php?action=editCategory&amp;categoryId=<?php echo $category->id?>'">
          <td>
            <?php echo $category->name?>
          </td>
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><?php echo $results['totalRows']?> categor<?php echo ( $results['totalRows'] != 1 ) ? 'ies' : 'y' ?> in total.</p>
 
      <p><a href="admin.php?action=newCategory">Add a New Category</a></p>
 </li> 
 </ul>

<ul class="homepage-grid" style="margin: 0 auto;">
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=newCategory">
			<i class="icon-plus-circle"></i>
			<h2>New Category</h2>
			<p>Create a new category.</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/?action=archive&categoryId=2">
			<i class="icon-popup"></i>
			<h2>View Category</h2>
			<p>All documents in specified category</p>
		</a>
	</li>
	<li>
		<a href="<?php DOMAIN; ?>/admin.php?action=editCategory&categoryId=1">
			<i class="icon-cog-alt"></i>
			<h2>Edit Category</h2>
			<p>http://adamtoms.co.uk/admin.php?action=editCategory&categoryId=1</p>
		</a>
	</li>
</ul>
<?php include "templates/include/admin/footer.php" ?>