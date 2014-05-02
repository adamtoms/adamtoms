<?php include "templates/include/header.php" ?>
 <ul class="mcontent">
	<li>
		<h1><?php echo htmlspecialchars( $results['article']->title )?></h1>
		<p><?php echo htmlspecialchars( $results['article']->summary )?></p>
		<div><?php echo $results['article']->content?></div>
		<h1><?php echo htmlspecialchars( $results['page_identifier']->page_identifier )?></h1>
	</li>
 </ul>
 <ul id="article-info">
 	 <li class="pubDate">Published on <?php echo date('j F Y', $results['article']->publicationDate)?></li>
    <li><a href="./">Return to Homepage</a></li>
</ul> 
<?php include "templates/include/footer.php" ?>