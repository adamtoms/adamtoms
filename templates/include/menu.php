<div class="menucontainer">
	<nav id="menuleft">
	<a class="navicon mtoggle" id="toggle-bar" href="#">Main Menu</a>

	<a href="<?php echo globalSetting('domain') ?>/" id="sLogo">
		<img src="<?php echo DOMAIN; ?>/images/logo.svg" id="logo" alt="Essex Kite Park logo">
		<div id="logo-text">Essex Kite Park</div> 
	</a>
	<nav class="mtogglecontact icon-phone" id="menucontact"></nav>
	<nav class="mtogglem icon-map" id="menumap"></nav> <!--<a href="#"></a>-->

	<ul id="mmenu">
		<?php viewMenuList();?>
	</ul>
	<ul id="mmenumap">
		<li>
			<a href="http://maps.apple.com/?q=51.566376,0.766009">Open Map</a>
			<div style="margin: 15px;"></div>
			<address id="menu-address">High House Farm, <br>Barling Road, <br>Essex <br>SS3 0LZ</address>
		</li>
	</ul>
	<ul id="mmenucontact">
		<li>
			<a href="mailto:adamtoms@hotmail.co.uk">adamtoms@hotmail.co.uk</a> 
		</li>
		<li>
			<a href="tel:07833476450">07833476440</a>
		</li>
	</ul>
    </nav>
</div>