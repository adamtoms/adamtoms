<div id="slider">
	<button style="float: left;left: 0;top: 43%;" onclick="mySwipe.prev()">&lt;</button> 
<button style="float: right;right: 0;top: 43%;" onclick="mySwipe.next()">&gt;</button>
<div id="mySwipe" style="max-width:950px;max-height:400px;margin:5% auto 0;box-shadow:0 6px 20px rgb(100,100,100)" class="swipe">
<!--
could i keep the float set. now they are inside setting left and right 0 should lock them to the inside of the parent div!
-->

	<div class="swipe-wrap" style="max-height: 355px;margin-bottom:-5px;">
		<div>
			<a href="#"><img src="http://r.adamtoms.co.uk/images/slider/snowboarding.jpg" alt="Snowboarding at Essex Kite Park" style="width: 100%;"></a>
		</div>
	    <div>
	    	<a href="#"><img src="http://r.adamtoms.co.uk/images/slider/clubhouse.jpg" alt="Photo of our clubhouse" style="width: 100%;"></a>
	    </div>
	    <div>
	    	<a href="#"><img src="http://r.adamtoms.co.uk/images/slider//kitesurfers.jpg" alt="Kitesurfers off Southend Beachfront" style="width: 100%;"></a>
	    </div>
<!--	    <div>
	    	<a href="#"><img src="http://r.adamtoms.co.uk/images/104.jpg" alt="Lewis Wilby on the Kickers" style="width: 100%;"></a>
	    </div> -->
	</div>
</div>

<div style="text-align:center;margin:10px 0;">
<!-- if 0 then what should i do, output or print? need to find a fallback incase java is disabled -->
</div>
<script src="templates/include/scripts/swipe.js"></script>

<!-- slide.js script was placed here -->
<script>

// pure JS
var elem = document.getElementById("mySwipe");
window.mySwipe = Swipe(elem, {
 startSlide: 0,
 speed:600,
 auto: 3000,
 continuous: true,
 disableScroll: false,
 stopPropagation: false,
 callback: function(index, element) {},
 transitionEnd: function(index, element) {}
});

// with jQuery
// window.mySwipe = $("#mySwipe").Swipe().data("Swipe");

</script>
</div>