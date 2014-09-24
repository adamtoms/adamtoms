<?php include "templates/include/header.php" ?>
 <ul class="mcontent">
 	<li><?php include "templates/include/admin/bread.php" ?></li>
 	
	<li><?php  /*echo htmlspecialchars( $results['homepages']->title )*/?>

		<p style="display:none;">ID:<?php echo htmlspecialchars( $results['homepages']->id )?></p>
		<p style="display:none;">Category ID:<?php echo htmlspecialchars( $results['homepages']->categoryId )?></p>
	<!--style="text-align: center;font-size: 1.7em;margin: -10px 0px 30px;"-->
		<p><?php echo htmlspecialchars( $results['homepages']->summary )?></p>
		<div><?php echo ( $results['homepages']->content )?></div>
		
		<h3 style="display: none;"><?php echo htmlspecialchars( $results['homepages']->page_identifier )?></h3>
		<!-- set this as the page title -->
		<p style="display: none"><?php echo htmlspecialchars( $results['category']->name )?></p>
	</li>

 <ul id="article-info">
 	 <li class="pubDate">Published on <?php echo date('j F Y', $results['homepages']->publicationDate)?>
 	 	<?php if ( $results['category'] ) { ?>
        	in <a href="./?action=archive&amp;categoryId=<?php echo $results['category']->id?>"><?php echo htmlspecialchars( $results['category']->name ) ?></a>
		<?php } ?>
 	 
 	 </li>
    <li><a href="<?php echo DOMAIN; ?>">Return to Homepage</a></li>
</ul>
 </ul>
<?php include "templates/include/footer.php" ?>