</main>
<footer>
<?php print'<div id="footer-wrap">'?>

<ul id="footer-list" style="list-style: none;">	
	<li id="facebook-f">
		<i class="icon-like"></i>
		<div class="footer-text">Facebook</div>
		<div class="fb-loader-content"></div>
		<div class="facebook-content"></div>
	</li>
	<li id="windguru">
		<i class="icon-weather"></i>
		<div class="footer-text">Weather</div>
		<div class="wg-loader-content"></div>
		<div class="windguru-content" style="overflow-x: auto;-webkit-overflow-scrolling:touch;" ></div>
	</li>
	<li>
		<i class="icon-phone"></i>
		<div class="footer-text">
			<a href="/membership">Membership</a>
		</div>
	</li>
	<li>
		<i class="icon-summersessions"></i>
		<div class="footer-text">
			<a href="/events">Summer Sessions</a>
		</div>
	</li>	
	<li>
		<i class="icon-more"></i>
		<div id="foot-viewMore" class="footer-text">
			<a href="#footer-right">More...</a><!-- onclick="return false;" -->
		</div><!-- arrow for icon -->
	</li>
	<li>Adam Toms &#169; 2014. All rights reserved.</li>
</ul>


<ul class="footer-right">
	<li style="list-style: none;font-size:1em;">Useful Links</li>
	<li><a href="/membership" >Membership</a></li><!--style="color:#EE6557;"-->
	<li><a href="http://www.windguru.cz/int/tide.php?id_spot=47924#" target="_blank">Tides</a></li>
	<li><a href="/contact">Contact Us</a></li>
	<li><a href="/about/links">Links</a></li>
	<li><a href="/about/terms-&amp;-disclaimer">Terms and Conditions</a></li>
	<li><a href="/archive">Article Archive</a></li>
	<li><a href="/admin.php">Login</a></li>
</ul>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN; ?>:8080/templates/include/scripts/core.js"></script>
<!--<script>window.jQuery || document.write('<script src="/site/javascript/vendor/jquery-1.9.1.min.js"><\/script>')</script>-->

<?php debugging(); ?>

</div>
<div id="back-top" class="icon-up-outline"></div>

</footer>
</body>
</html>

<?php 
//$e = microtime(true);
//echo  round($e - $s, 5) . " Sec";
?>