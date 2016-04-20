/*
 columnsundo - JQuery widget to turn multi-list columns into one list.  The reverse of jquery.columns.plugin.js which turns one list into multiple lists.
*/

(function($) {
    'use strict';
    $.fn.colsundo = function(options) {

        var settings = {
        };

        // Extend options.
        options = options || {};
        $.extend(settings, options);

        // $this = element from plugin selector
        var $this = this;

        this.each(function() {
            var that = $(this);

            var config = {
            };

            that.each(function() {
                if ($(this).index() != 0) {
                    var $first = $(this).siblings().first();
                    $(this).find('li').appendTo($first)
                    $(this).remove();

                }
            });
        });

        return this;
    };

})(jQuery);