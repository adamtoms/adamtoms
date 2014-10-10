<?php include "templates/include/header.php" ?>
 <ul class="mcontent">
 	<li><?php include "templates/include/bread.php" ?></li>
	<li>
		<!--http://adamtoms.co.uk/?action=viewCategoryNameandArticle&categoryName=events&page_identifier=contact-->
		<p style="display: none">Cat ID:<?php echo htmlspecialchars( $results['category']->id )?></p>
		<p style="display: none">Cat Name:<?php echo htmlspecialchars( $results['category']->name )?></p>
		<p style="display: none">Cat Description:<?php echo htmlspecialchars( $results['category']->description )?></p>

		<p><?php echo htmlspecialchars( $results['article']->summary )?></p>
		<div><?php echo $results['article']->content?></div>
		<h1><?php echo htmlspecialchars( $results['page_identifier']->page_identifier )?></h1>
		<!-- this is doing nothing. need to make it work. related to menu-->
		<div>
			<?php if ( $imagePath = $results['article']->getImagePath() ) { ?>
			<img id="articleImageFullsize" src="/<?php echo $imagePath?>" alt="Article Image" style="max-width:100%;" />
      <?php } ?>

      </div>
      
      
      
		
		
	</li>
	<ul id="article-info">
		<li class="pubDate">Published on <?php echo date('j F Y', $results['article']->publicationDate)?>
 	 	<?php if ( $results['category'] ) { ?>
        	in <a href="./?action=archive&amp;categoryId=<?php echo $results['category']->id?>"><?php echo htmlspecialchars( $results['category']->name ) ?></a>
		<?php } ?>
 	 
 	 </li>
    <li><a href="<?php echo DOMAIN; ?>">Return to Homepage</a></li>
</ul>
</ul>
<?php include "templates/include/footer.php" ?>