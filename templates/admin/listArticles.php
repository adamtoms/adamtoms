<?php include "templates/include/admin/header.php" ?>
<?php include "templates/include/admin/bread.php" ?>
 
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
          <th>Publication Date</th>
          <th>Article</th>
          <th>Category</th>
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
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="admin.php?action=newArticle">Add a New Article</a></p>
</li>
</ul>
<?php include "templates/include/admin/footer.php" ?>