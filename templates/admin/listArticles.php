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
          <th style="text-align: center">Live</th>
        </tr>
 
<?php foreach ( $results['articles'] as $article ) { ?>
 
        <tr onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>'">
			<td><?php echo date('j M Y', $article->publicationDate)?></td>
			<td title="id=<?php echo $article->id; ?>"><?php echo $article->title?></td>
			<td><?php echo $results['categories'][$article->categoryId]->name?></td>
			<td style="width: 8%;">
				<a href="<?php if ($results['categories'][$article->categoryId]->name == FALSE) {echo 'about';} 
				else {
					echo $results['categories'][$article->categoryId]->name;};?>/<?php if($article->page_identifier == FALSE) {
					echo '?action=viewArticle&articleId=';
					echo $article->id;
					echo '">n/a Using ID';
          		}
			else {echo $article->page_identifier .'">View Live';};?></a>
			</td>
			<td style="text-align: center;" id="live"><?php echo $article->live?></td>
        </tr>
<?php } ?>
      </table>
 
      <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="admin.php?action=newArticle">Add a New Article</a></p>
</li>
</ul>


<!--old code <a href="<?php // if ($results['categories'][$article->categoryId]->name == FALSE) {
          	//	echo 'about';
          	//	} 
          	//else {echo $results['categories'][$article->categoryId]->name;};?>/<?php 
          	//if($article->page_identifier == FALSE) {
          	//	echo '">None Set';
          		/* not sure what to add here echo'#set-identifier'; */
          	//}
			//else {echo $article->page_identifier .'">View Live';};?></a>
				
-->

<?php include "templates/include/admin/footer.php" ?>
