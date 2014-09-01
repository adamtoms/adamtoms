// JavaScript Document
jQuery(document).ready(function () {

$(".statusMessage").fadeIn('slow').delay(3000).fadeOut('slow');



var ZipFiles = document.getElementById("ZipFiles");
ZipFiles.onclick = (function () {
    "use strict";
    var count = 0;
    return function () {
        count = count + 1;
        if (count === 1) {    // do something on first click
        	$('#ZipFiles').hide();
            $('#ZipButton').addClass('loader');
			$.post("/templates/admin/components/zip.php?action=mkZip", function(){
			// work out how to post to status message?	$.post("", function(){});
                $('#ZipButton').removeClass('loader');
                $('#ZipDownload').show();
            });
        }
        if (count > 1) {
            $.noop();
        }
    };
}());

var rmZip = document.getElementById("rmZip");
rmZip.onclick = (function () {
    "use strict";
    var count = 0;
    return function () {
        count = count + 1;
        if (count === 1) {    // do something on first click
        	$('#rmZip').hide();
            $('#rmZipButton').addClass('loader');
			$.post("/templates/admin/components/zip.php?action=rmZip", function(){
                $('#rmZipButton').removeClass('loader');
                $("#zipRemoved").fadeIn('slow').delay(3000).fadeOut('slow');
               // $("zipRemoved").show();
            });
        }
        if (count > 1) {
            $.noop();
        }
    };
}());




});