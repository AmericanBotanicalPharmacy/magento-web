/*
 hoverintentresponsive - JQuery widget wrapper for standard hoverIntent plugin. Responsive switche between hoverIntent for desktop and standard hover for other devices.

 - Implement as plugin NOT a widget. We don't want/need an instance for each object.
*/

(function ($) {

    var settings = {
        onOver: $.noop,
        onOut: $.noop,
        interval: 100
    };

    var methods = {
        init: function (options) { if (options) { $.extend(settings, options); } return init(this, settings); },
        destroy: function (options) { if (options) { $.extend(settings, options); } return destroy(this, settings); }
    };

    $.fn.hoverintentresponsive = function (method) {
        // Method calling logic
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery plugin');
        }
    };

    var init = function (object, settings) {

        var config = {
            over: settings.onOver,
            out: settings.onOut,
            interval: settings.interval
        };

        enquire.register(_responsive.mqIsDesktop, {

            // Unmatch does not fire on page load. Use setup for first init.
            setup: function() {
                if (Modernizr.mq(_responsive.mqIsDesktop)) {
                    object.hoverIntent(config);
                }
                else {
                    object.hover(settings.onOver);
                }
            },
            match: function() {
                // Remove any standard hover event.
                object.off('mouseenter').off('mouseleave').off('hover');

                // Add hover intent event.
                object.hoverIntent(config);
            },
            unmatch: function() {
                // Remove any hover intent events.
                object.off('mouseenter').off('mouseleave').off('hover');

                // Add standard hover event.
                object.hover(settings.onOver);
            }
        });
    }

    var destroy = function(object, settings) {
        object.off('mouseenter').off('mouseleave').off('hover');
    }

})(jQuery);
