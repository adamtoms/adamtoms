<?php include "templates/include/header.php" ?>
	<aside>
		<?php /* echo hash ( 'SHA512', 'adam')*/ ?>
		<div class="slider-content"></div>
	</aside>
		<?php foreach ( $results['articles'] as $article ) { ?>
	<ul>
		<li>
			<h2>
            <span class="pubDate"><?php echo date('j F', $article->publicationDate)?></span><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars( $article->title )?></a>
			</h2>
          <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
        </li>
<?php } ?>
 		<ul class="advertone">
			<li>
				<a href="/pages/the-park">	
					<h1>The Park</h1>
					<p>22 acres of cut grass. Ramps, sliders, good wind, friendly members and onsite toilets.</p> 
					<img alt="advert1" src="./images/buggy.jpg">			
					<p class="readmore">read more...</p>
				</a>
			</li>
			<li class="sep">
				<a href="/?action=viewArticle&articleId=1">	
					<h2>News</h2>
					<p>Find out whats going on at the Park. <!--blog/news on AGM/Event Writeups/reviews/writeups/general news.--></p>
					<img alt="advert2" src="./images/clubhouse.jpg">
					<p class="readmore">read more...</p>
				</a>
			</li>
			<li class="sep" id="adthree">
				<a href="/pages/lessons">	
					<h2>Lessons</h2>
					<p>Learn from professionals.<Br>You'll leave a safe, self sufficient rider. Capable of flying safely & independantly.</p>
					<img alt="advert3" src="./images/kitesurf.png">
					<p class="readmore">read more...</p>
				</a>
			</li>
		</ul>

<?php include "templates/include/footer.php" ?>