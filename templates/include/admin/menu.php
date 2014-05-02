<?php
print'  <div class="menucontainer">' ?>


	<nav id="menuleft">
	
	<a class="navicon mtoggle" id="toggle-bar" href="#">Main Menu</a>
	<!-- <img src="../images/logo.svg" style="height: 60px;margin: -13px 0 0 5%;">			
	 <div class="sprite-logo"></div> 
	<div class="sprite-small-logo"></div> -->
	            
		<nav class="mtogglecontact" id="menucontact">
			<a href="#">Contact</a>
		</nav>
        
		<nav class="mtogglem" id="menumap">
			<a href="#">Map</a>
		</nav>

		<ul id="mmenu">
			<li><a href="/admin">Admin</a></li>
		    <li><a href="/admin.php?action=newArticle">New Article</a></li>
		    <li><a href="/">Front Page</a></li>
			<li><a href="/?action=archive">Archive</a></li>
			<li><a href="/templates/admin/components/zip.php">Zip</a></li>
		</ul> 
           
	<!-- map dropdown -->
        <ul id="mmenumap">
			<li>
			<a href="http://maps.apple.com/?q=51.566376,0.766009">Open Map</a>
<!--geo: comgooglemaps: url schema -->
			<div style="margin: 15px;"></div>
            <address id="menu-address">High House Farm, <br>Barling Road, <br>Essex <br>SS3 0LZ</address>
			</li>
		</ul>
            
            <!-- content for contact dropdown -->

            <ul id="mmenucontact">
					<li style="color: white;">
						<a href="mailto:adamtoms@hotmail.co.uk">adamtoms@hotmail.co.uk</a> 
					</li>
					<li>  
						<a href="tel:07833476450">07833476440</a> 
					</li>
			</ul>
        </nav>
    </div>
