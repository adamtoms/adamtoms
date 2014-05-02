/*jslint browser: true*/
/*global $, jQuery, alert*/
jQuery(document).ready(function ($) {
    "use strict";
    $(".mtoggle").click(function () {
        $("#mmenumap,#mmenucontact").hide(400);
        $("#mmenu").slideToggle(200);
        return false;  //stops the default action
    });

    $(".mtogglem").click(function () {
        $("#mmenu,#mmenucontact").hide(400);
        $("#mmenumap").slideToggle(200);
        return false;
    });

    $(".mtogglecontact").click(function () {
        $("#mmenu,#mmenumap").hide(400);
        $("#mmenucontact").slideToggle(200);
        return false;
    });

    $(".advertone,.mcontent,aside").click(function () {
        $("#mmenu,#mmenumap,#mmenucontact").hide();
    });

//find window width and load appropriate content
    $(window).width();
    var width = $(window).width();
    if (width >= 642) {
        $('.slider-content').load("templates/include/slider.php", function () {
            $('.slider-content').show(400);
        });
    } else {
        $.noop();
    }

//scroll to top
   // $("#back-top").hide();
    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 500) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

}); //end  document.ready

//Show more button in footer.
$("#foot-viewMore").click(function () {
    "use strict";
    $(".footer-right").slideToggle('slow', function () {
        var height = $('.footer-right').height();
        var pageHeight = $('html').height();
        if ($(this).is(':visible')) {
            $(window).scrollTop(height + pageHeight);
           //could i change the properties of the scroll top to animate only once pageheight is over?
            return false;
        }
    });
});

//two classes, each one with a loading arrow, to change when open and hidden.
//menu slide in from left
//the reason the phone shows white space is something to do with the overflow!


//Could i combine these functions or at least part of the function with function()
var windguruFoot = document.getElementById("windguru");
windguruFoot.onclick = (function () {
    "use strict";
    var count = 0;     // init the count to 0
    return function () {
        count++;       //count
        if (count === 1) {    // do something on first click
            $('.wg-loader-content').addClass('loader');
            $('.windguru-content').load("../templates/include/scripts/windguru.html", function () {
                $('.wg-loader-content').removeClass('loader');
            });
        }
        if (count > 1) {
            $('.windguru-content').slideToggle(400);
        }
    };
})
();


var facebookFoot = document.getElementById("facebook-f");
facebookFoot.onclick = (function () {
    "use strict";
    var count = 0;     // init the count to 0
    return function () {
        count++;       //count
        if (count === 1) {    // do something on first click
            $('.fb-loader-content').addClass('loader');
            $('.facebook-content').load("../templates/include/scripts/facebook.php", function () {
                $('.fb-loader-content').removeClass('loader');
            });
        }
        if (count > 1) {
            $('.facebook-content').slideToggle(400);
        }
    };
})
();