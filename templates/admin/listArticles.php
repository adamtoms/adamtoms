<?php include "templates/include/admin/header.php" ?>
<?php include "templates/include/admin/bread.php" ?>

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
	
  <ul class="mcontent">
 	<li>
      <table>
        <tr>
          <th>Publication Date</th>
          <th>Article</th>
          <th>Category</th>
          <th></th>
        </tr>
 
<?php foreach ( $results['articles'] as $article ) { ?>
 
        <tr onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>'">
          <td><?php echo date('j M Y', $article->publicationDate)?></td>
          <td>
            <?php echo $article->title?>
          </td>
           <td>
            <?php echo $results['categories'][$article->categoryId]->name?>
          </td>
          <td style="width: 8%;">
          	<a href="<?php echo $results['categories'][$article->categoryId]->name?>/<?php echo $article->title?>">View Live</a>
          </td>
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="admin.php?action=newArticle">Add a New Article</a></p>
</li>
</ul>
<?php include "templates/include/admin/footer.php" ?>