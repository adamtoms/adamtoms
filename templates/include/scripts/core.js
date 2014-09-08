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

}); //end document.ready


//Show more button in footer.
$("#foot-viewMore").click(function () {
    "use strict";
    $(".footer-right").slideToggle('slow', function () {
//        var height = $('.footer-right').height();
//        var pageHeight = $('html').height();
        var totalHeight = $('.footer-right').height() + $('html').height();
        if ($(this).is(':visible')) {
            $(window).scrollTop(totalHeight);
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
        count = count + 1;       //was count++; js lint said no!
        if (count === 1) {    // do something on first click
            $('.wg-loader-content').addClass('loader');
            $('.windguru-content').load("/templates/include/scripts/windguru/index.php", function () {
                $('.wg-loader-content').removeClass('loader');
            });
        }
        if (count > 1) {
            $('.windguru-content').slideToggle(400);
        }
    };
}());
//http://adamtoms.co.uk/templates/include/scripts/windguru/index.php
//../templates/include/scripts/windguru.php
var facebookFoot = document.getElementById("facebook-f");
facebookFoot.onclick = (function () {
    "use strict";
    var count = 0;     // init the count to 0
    return function () {
        count = count + 1;       //was count++; js lint said no!
        if (count === 1) {    // do something on first click
            $('.fb-loader-content').addClass('loader');
            $('.facebook-content').load("templates/include/scripts/facebook.php", function () {
                $('.fb-loader-content').removeClass('loader');
            });
        }
        if (count > 1) {
            $('.facebook-content').slideToggle(400);
        }
    };
}()); // was }) (); jslint no..


/* $(document).ready(function () {    
    //Get CurrentUrl variable by combining origin with pathname, this ensures that any url appendings (e.g. ?RecordId=100) are removed from the URL
    var CurrentUrl = window.location.origin+window.location.pathname;
    //Check which menu item is 'active' and adjust apply 'active' class so the item gets highlighted in the menu
    //Loop over each <a> element of the NavMenu container
    $('#mmenu a').each(function(Key,Value)
        {
            //Check if the current url
            if(Value['href'] === CurrentUrl)
            {
                //We have a match, add the 'active' class to the parent item (li element).
                $(Value).parent().addClass('active');
            }
        });
       // $('#mmenu').html(CurrentUrl);
 }); */