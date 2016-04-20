/*

Search to hide and show dropdown on Tablet, but not mobile.

 */        

(function ($) {
    'use strict';
    $.widget('aydus.tabletsearch', {

        options: {
        },

        _create: function () {

            $('a.close').hide();
            $('#tabletSearch').hide();
            $('#tabletSearch').before('<div class="arrow"></div>');
            $('a.tablet-search').click(function() {
                $('#tabletSearch').fadeIn("fast");
                $('.arrow').fadeIn("slow");
                $('a.tablet-search').fadeOut("fast");
                $('a.close').show();

            });
            $('a.close').click(function() {
                $('#tabletSearch').fadeOut("fast");
                $('.arrow').fadeOut("fast");
                $('a.close').hide();
                $('a.tablet-search').show();
            });
            
            /*
             * Put the table search field value in the regular search field
             */
            var skipValidation = function()
            {
            	var val =  $('#search2').val();
            	$('#search').val(val);
            }
            
            $('#search2').blur(skipValidation);
            $('#tabletSearch button[type=submit]').click(skipValidation);
            
        }

    });
}(jQuery));