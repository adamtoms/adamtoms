<div class="menucontainer">
	<nav id="menuleft">
	
	<a class="navicon mtoggle" id="toggle-bar" href="#">Main Menu</a>
	<!-- <img src="/images/logo.svg" style="height: 60px;margin: -13px 0 0 5%;">			
	 <div class="sprite-logo"></div> 
	<div class="sprite-small-logo"></div> -->
	            
		<nav class="mtogglecontact" id="menucontact">
			<i class="icon-lock-open" style="font-size: 1.4em;margin: 5%;"></i>
		</nav>
        
	<!--	<nav class="mtogglem" id="menumap">
			<a href="#">M</a>
		</nav> -->
		
		<div id="adminWelcome">
			<p>Welcome, 
			<?php 
			if($_SESSION['username'] == TRUE) {
			echo htmlspecialchars( $_SESSION['username']) ."!";	
			}
			else {
				echo 'User';
			};
			?>
			</p>
		<!--	<a href="admin.php?action=logout"?>Logout</a> -->
		</div>

		<ul id="mmenu">
			<li><a href="<?php DOMAIN; ?>/admin.php" style="display:block;">Home</a></li>
		    <li><a href="<?php DOMAIN; ?>/">Live</a></li>
			<li><a href="<?php DOMAIN; ?>/admin.php?action=zipSite">Zip</a></li>		    
		    <li><a href="admin.php?action=logout"? alt="logout"><i class="icon-lock-open"></i></a></li>
		</ul> 
           
	<!-- map dropdown -->
        <ul id="mmenumap">
			<li><!--
			<a href="http://maps.apple.com/?q=51.566376,0.766009">Open Map</a>
			<div style="margin: 15px;"></div>
            <address id="menu-address">High House Farm, <br>Barling Road, <br>Essex <br>SS3 0LZ</address>-->
			</li>
		</ul>
            
            <!-- content for contact dropdown -->

            <ul id="mmenucontact">
            				<li><a href="admin.php?action=logout"?>Logout</a></li>
<!--
					<li style="color: white;">
						<a href="mailto:adamtoms@hotmail.co.uk">adamtoms@hotmail.co.uk</a> 
					</li>
					<li>  
						<a href="tel:07833476450">07833476440</a> 
					</li>-->
			</ul>
        </nav>
    </div>
