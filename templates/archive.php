<?php include "templates/include/header.php" ?>

<h1><?php echo htmlspecialchars( $results['pageHeading'] ) ?></h1>

<ul class="mcontent">
   	<li>
   		<?php if ( $results['category'] ) { ?>
 		<h3 class="categoryDescription"><?php echo htmlspecialchars( $results['category']->description ) ?></h3>
		<?php } ?>
	</li>
</ul>

<ul id="headlines" class="archive mcontent">
	<?php foreach ( $results['articles'] as $article ) { ?>
	<li>
		<h3>
			<span class="pubDate">
				<?php echo date('j F Y', $article->publicationDate)?>
			</span>
			<a href="/<?php echo htmlspecialchars( $results['categories'][$article->categoryId]->name ) ?>
			/<?php echo htmlspecialchars( $article->page_identifier )?>">
				<?php echo htmlspecialchars( $article->title )?>
			</a>
        	<?php if ( !$results['category'] && $article->categoryId ) { ?>
        	<span class="category">in 
				<a href=".?action=archive&amp;categoryId=
					<?php echo $article->categoryId?>">
					<?php echo htmlspecialchars( $results['categories'][$article->categoryId]->name ) ?>
				</a>
            </span>
			<?php } ?>
		</h3>
		<p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
	</li>
	<?php } ?>
	<li>
    	<p>
    		<?php echo $results['totalRows']?>
    		article
    		<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?>
    		in total.
    	</p>	
	</li>
	<li>
		<a href="./">Return to Homepage</a>	
	</li>
</ul>

<!--
--Original code for using ID to set page URL
--<a href=".?action=viewArticle&amp;articleId=<?php /* echo $article->id?>"><?php echo htmlspecialchars( $article->title )*/ ?></a>
------>
<!--  <p class="page_identifier"><a href="/pages/<?php /* echo htmlspecialchars( $article->page_identifier )*/?>">{icon}</a></p> -->

 <!--	add anchor inside li as block <a href="/pages/<?php echo htmlspecialchars( $article->page_identifier )?>" style="display:block;height:inherit;width:inherit;"> -->

<?php include "templates/include/footer.php" ?>