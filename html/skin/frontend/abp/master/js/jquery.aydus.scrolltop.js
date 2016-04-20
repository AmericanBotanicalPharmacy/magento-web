/*
 scrolltop - JQuery scroll to top widget.

 Requires:
 ScrollTo plugin.
 */

(function ($) {
    'use strict';
    $.widget('aydus.scrolltop', {

        options: {
            containerId: 'scrolltop-container',
            enableGoogleEvents: false
        },

        _create: function () {
            var that = this;

            var html = $('<div><div class="inner-tube"><div class="image"></div></div>').attr('id', that.options.containerId);
            that.element.append(html);

            that.element.on('click', '#' + that.options.containerId, function () {
                if ($(window).scrollTop() > 0) {

                    // Scroll page to top.
                    that._scroll();

                    if (that.options.enableGoogleEvents) {
                        _store.googleEventTracker('ScrollTop', 'Click', '');
                    }
                }
            });

            $(window).scroll(function(){
                $.doTimeout('scroll', 250, function() {
                    var $container = $('#' + that.options.containerId);
                    if ($(window).scrollTop() > 0) {
                        that._show();
                    }
                    else {
                        that._hide();
                    }
                });
            });
        },

        _show: function() {
            var that = this;

            var $container = $('#' + that.options.containerId);
            $container.stop().fadeTo(2000, 1);
        },

        _hide: function() {
            var that = this;

            var $container = $('#' + that.options.containerId);
            $container.stop().fadeTo(400, 0);
        },

        _scroll: function() {
            var that = this;

            $.scrollTo(0, 600);
        }

    });
}(jQuery));