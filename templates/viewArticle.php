<?php include "templates/include/header.php" ?>
 <ul class="mcontent">
	<li>
		
		<h1><?php echo htmlspecialchars( $results['article']->title )?></h1>
		
	<!--	<h1><?php /* echo htmlspecialchars( $results ['categories']->categoryName )*/?></h1> -->
		
		<p><?php echo htmlspecialchars( $results['article']->summary )?></p>
		<div><?php echo $results['article']->content?></div>
		<h1><?php echo htmlspecialchars( $results['page_identifier']->page_identifier )?></h1> <!-- this is doing nothing. need to make it work. related to menu-->
	</li>
 </ul>
 <ul id="article-info">
 	 <li class="pubDate">Published on <?php echo date('j F Y', $results['article']->publicationDate)?>
 	 	<?php if ( $results['category'] ) { ?>
        	in <a href="./?action=archive&amp;categoryId=<?php echo $results['category']->id?>"><?php echo htmlspecialchars( $results['category']->name ) ?></a>
		<?php } ?>
 	 
 	 </li>
    <li><a href="<?php echo DOMAIN; ?>">Return to Homepage</a></li>
</ul>

<?php include "templates/include/footer.php" ?>