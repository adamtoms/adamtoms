<div id="slider">

<button style="float: left;left: 0px;top: 33%;font-size: 5em;" onclick="mySwipe.prev()" class="icon-left-open-big"></button><!-- &lt; &gt; -->
<button style="float: right;right: 0;top: 33%;font-size: 5em;" onclick="mySwipe.next()" class="icon-right-open-big"></button>

<div id="mySwipe" style="max-width:950px;max-height:400px;margin:5% auto 0;box-shadow:0 6px 20px rgb(100,100,100)" class="swipe">

	<div class="swipe-wrap" style="max-height: 355px;margin-bottom:-5px;">
		<div>
			<a href="/pages/membership"><img src="//adamtoms.co.uk/images/slider/membership.jpg" alt="Snowboarding at Essex Kite Park" style="width: 100%;"></a>
		</div>
	    <div>
	   		<a href="/pages/lessons"><img src="//adamtoms.co.uk/images/slider/kitesurfing.jpg" alt="Kitesurfers off Southend Beachfront" style="width: 100%;"></a>
	    </div>
	    <div>
	    	<a href="/pages/events"><img src="//adamtoms.co.uk/images/slider/summer-sessions-2014.jpg" alt="2014 Event Dates Photo of people spectating" style="width: 100%;"></a>
	    </div>
	    <div>
	    	<a href="/pages/the-park"><img src="//adamtoms.co.uk/images/slider/open-all-year.jpg" alt="We are open year round! Photo of JB Snow Kiting" style="width: 100%;"></a>
	    </div>
<!--	    <div>
	    	<a href="#"><img src="http://r.adamtoms.co.uk/images/104.jpg" alt="Lewis Wilby on the Kickers" style="width: 100%;"></a>
	    </div> -->
	</div>
</div>

<div style="text-align:center;margin:10px 0;">
<!-- if 0 then what should i do, output or print? need to find a fallback incase java is disabled -->
</div>

<script type="text/javascript">function Swipe(m,e){var f=function(){};var u=function(C){setTimeout(C||f,0)};var B={addEventListener:!!window.addEventListener,touch:("ontouchstart" in window)||window.DocumentTouch&&document instanceof DocumentTouch,transitions:(function(C){var E=["transitionProperty","WebkitTransition","MozTransition","OTransition","msTransition"];for(var D in E){if(C.style[E[D]]!==undefined){return true}}return false})(document.createElement("swipe"))};if(!m){return}var c=m.children[0];var s,d,r,g;e=e||{};var k=parseInt(e.startSlide,10)||0;var v=e.speed||300;e.continuous=e.continuous!==undefined?e.continuous:true;function n(){s=c.children;g=s.length;if(s.length<2){e.continuous=false}if(B.transitions&&e.continuous&&s.length<3){c.appendChild(s[0].cloneNode(true));c.appendChild(c.children[1].cloneNode(true));s=c.children}d=new Array(s.length);r=m.getBoundingClientRect().width||m.offsetWidth;c.style.width=(s.length*r)+"px";var D=s.length;while(D--){var C=s[D];C.style.width=r+"px";C.setAttribute("data-index",D);if(B.transitions){C.style.left=(D*-r)+"px";q(D,k>D?-r:(k<D?r:0),0)}}if(e.continuous&&B.transitions){q(i(k-1),-r,0);q(i(k+1),r,0)}if(!B.transitions){c.style.left=(k*-r)+"px"}m.style.visibility="visible"}function o(){if(e.continuous){a(k-1)}else{if(k){a(k-1)}}}function p(){if(e.continuous){a(k+1)}else{if(k<s.length-1){a(k+1)}}}function i(C){return(s.length+(C%s.length))%s.length}function a(G,D){if(k==G){return}if(B.transitions){var F=Math.abs(k-G)/(k-G);if(e.continuous){var C=F;F=-d[i(G)]/r;if(F!==C){G=-F*s.length+G}}var E=Math.abs(k-G)-1;while(E--){q(i((G>k?G:k)-E-1),r*F,0)}G=i(G);q(k,r*F,D||v);q(G,0,D||v);if(e.continuous){q(i(G-F),-(r*F),0)}}else{G=i(G);j(k*-r,G*-r,D||v)}k=G;u(e.callback&&e.callback(k,s[k]))}function q(C,E,D){l(C,E,D);d[C]=E}function l(D,G,F){var C=s[D];var E=C&&C.style;if(!E){return}E.webkitTransitionDuration=E.MozTransitionDuration=E.msTransitionDuration=E.OTransitionDuration=E.transitionDuration=F+"ms";E.webkitTransform="translate("+G+"px,0)translateZ(0)";E.msTransform=E.MozTransform=E.OTransform="translateX("+G+"px)"}function j(G,F,C){if(!C){c.style.left=F+"px";return}var E=+new Date;var D=setInterval(function(){var H=+new Date-E;if(H>C){c.style.left=F+"px";if(A){x()}e.transitionEnd&&e.transitionEnd.call(event,k,s[k]);clearInterval(D);return}c.style.left=(((F-G)*(Math.floor((H/C)*100)/100))+G)+"px"},4)}var A=e.auto||0;var w;function x(){w=setTimeout(p,A)}function t(){A=0;clearTimeout(w)}var h={};var y={};var z;var b={handleEvent:function(C){switch(C.type){case"touchstart":this.start(C);break;case"touchmove":this.move(C);break;case"touchend":u(this.end(C));break;case"webkitTransitionEnd":case"msTransitionEnd":case"oTransitionEnd":case"otransitionend":case"transitionend":u(this.transitionEnd(C));break;case"resize":u(n.call());break}if(e.stopPropagation){C.stopPropagation()}},start:function(C){var D=C.touches[0];h={x:D.pageX,y:D.pageY,time:+new Date};z=undefined;y={};c.addEventListener("touchmove",this,false);c.addEventListener("touchend",this,false)},move:function(C){if(C.touches.length>1||C.scale&&C.scale!==1){return}if(e.disableScroll){C.preventDefault()}var D=C.touches[0];y={x:D.pageX-h.x,y:D.pageY-h.y};if(typeof z=="undefined"){z=!!(z||Math.abs(y.x)<Math.abs(y.y))}if(!z){C.preventDefault();t();if(e.continuous){l(i(k-1),y.x+d[i(k-1)],0);l(k,y.x+d[k],0);l(i(k+1),y.x+d[i(k+1)],0)}else{y.x=y.x/((!k&&y.x>0||k==s.length-1&&y.x<0)?(Math.abs(y.x)/r+1):1);l(k-1,y.x+d[k-1],0);l(k,y.x+d[k],0);l(k+1,y.x+d[k+1],0)}}},end:function(E){var G=+new Date-h.time;var D=Number(G)<250&&Math.abs(y.x)>20||Math.abs(y.x)>r/2;var C=!k&&y.x>0||k==s.length-1&&y.x<0;if(e.continuous){C=false}var F=y.x<0;if(!z){if(D&&!C){if(F){if(e.continuous){q(i(k-1),-r,0);q(i(k+2),r,0)}else{q(k-1,-r,0)}q(k,d[k]-r,v);q(i(k+1),d[i(k+1)]-r,v);k=i(k+1)}else{if(e.continuous){q(i(k+1),r,0);q(i(k-2),-r,0)}else{q(k+1,r,0)}q(k,d[k]+r,v);q(i(k-1),d[i(k-1)]+r,v);k=i(k-1)}e.callback&&e.callback(k,s[k])}else{if(e.continuous){q(i(k-1),-r,v);q(k,0,v);q(i(k+1),r,v)}else{q(k-1,-r,v);q(k,0,v);q(k+1,r,v)}}}c.removeEventListener("touchmove",b,false);c.removeEventListener("touchend",b,false)},transitionEnd:function(C){if(parseInt(C.target.getAttribute("data-index"),10)==k){if(A){x()}e.transitionEnd&&e.transitionEnd.call(C,k,s[k])}}};n();if(A){x()}if(B.addEventListener){if(B.touch){c.addEventListener("touchstart",b,false)}if(B.transitions){c.addEventListener("webkitTransitionEnd",b,false);c.addEventListener("msTransitionEnd",b,false);c.addEventListener("oTransitionEnd",b,false);c.addEventListener("otransitionend",b,false);c.addEventListener("transitionend",b,false)}window.addEventListener("resize",b,false)}else{window.onresize=function(){n()}}return{setup:function(){n()},slide:function(D,C){t();a(D,C)},prev:function(){t();o()},next:function(){t();p()},getPos:function(){return k},getNumSlides:function(){return g},kill:function(){t();c.style.width="auto";c.style.left=0;var D=s.length;while(D--){var C=s[D];C.style.width="100%";C.style.left=0;if(B.transitions){l(D,0,0)}}if(B.addEventListener){c.removeEventListener("touchstart",b,false);c.removeEventListener("webkitTransitionEnd",b,false);c.removeEventListener("msTransitionEnd",b,false);c.removeEventListener("oTransitionEnd",b,false);c.removeEventListener("otransitionend",b,false);c.removeEventListener("transitionend",b,false);window.removeEventListener("resize",b,false)}else{window.onresize=null}}}}if(window.jQuery||window.Zepto){(function(a){a.fn.Swipe=function(b){return this.each(function(){a(this).data("Swipe",new Swipe(a(this)[0],b))})}})(window.jQuery||window.Zepto)};</script>
<!-- <script src="templates/include/scripts/swipe.js"></script> -->

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