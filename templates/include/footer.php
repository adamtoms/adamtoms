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
		<div class="windguru-content" style="overflow-x: auto;" ></div>
	</li>
	<li>
		<i class="icon-phone"></i>
		<div class="footer-text">
			<a href="/pages/membership">Membership</a>
		</div>
	</li>
	<li>
		<i class="icon-summersessions"></i>
		<div class="footer-text">
			<a href="/pages/events">Summer Sessions</a>
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
	<li><a href="/pages/membership" style="color:#EE6557 !important;">Membership</a></li>
	<li>Tides</li>
	<li><a href="/pages/contact">Contact Us</a></li>
	<li><a href="/pages/links">Links</a></li>
	<li><a href="/pages/terms-&amp;-disclaimer">Terms and Conditions</a></li>
	<li><a href="<?php echo DOMAIN; ?>/?action=archive">Article Archive</a></li>
	<li><a href="/admin">Login</a></li>
</ul>





<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php DOMAIN; ?>/templates/include/scripts/core.js"></script>
<!--<script>window.jQuery || document.write('<script src="/site/javascript/vendor/jquery-1.9.1.min.js"><\/script>')</script>-->
</div>
<div id="back-top" class="icon-up-outline"></div>

</footer>
</body>
</html>