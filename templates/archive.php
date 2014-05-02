<?php include "templates/include/header.php" ?>

	<h1>Article Archive</h1>

    <ul id="headlines" class="archive mcontent">
<?php foreach ( $results['articles'] as $article ) { ?>
 
        <li>
          <h3>
            <span class="pubDate"><?php echo date('j F Y', $article->publicationDate)?></span><a href="/pages/<?php echo htmlspecialchars( $article->page_identifier )?>"><?php echo htmlspecialchars( $article->title )?></a>
          </h3>
          <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
          <p class="page_identifier"><a href="/pages/<?php echo htmlspecialchars( $article->page_identifier )?>">{icon}</a></p>
        </li>
 
 
<!-----
--Original code for using ID to set page URL
--<a href=".?action=viewArticle&amp;articleId=<?php /* echo $article->id?>"><?php echo htmlspecialchars( $article->title )*/ ?></a>
------>
 
<?php } ?>
 <li>
       <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>	
 </li>
 <li>
 <a href="./">Return to Homepage</a>	
 </li>
      </ul>

 
<?php include "templates/include/footer.php" ?>