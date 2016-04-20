/*
 megamenu - JQuery lite responsive mega menu.
*/

(function ($) {
    'use strict';
    $.widget('aydus.megamenu', {

        _create: function() {
            var that = this;

            // Toggle main class desktop/mobile.
            enquire.register(_responsive.mqMobile, {
                setup: function() {
                    that.element.addClass('desktop');
                },
                match: function() {
                    that.element.removeClass('desktop');
                },
                unmatch: function() {
                    that.element.addClass('desktop');
                }
            });

            $('.sub > h3', that.element).hoverintentresponsive({
                onOver: onMenuOver,
                interval: 200
            });

            // On hover, show.
            function onMenuOver(e) {
                that._show($(this));
            }

            // Hide megamenu on mouse leave.
            that.element.on('mouseleave', function() {
                that._hide();
            });

            // Close megamenu on click.
            that.element.on('click', '.close', function() {
                that._hide();
            });
        },

        _show: function($element) {
            var that = this;

            // Bug fix tablet. Tap on container results in show (but only one time after menu already shown). Subsequent clicks do nothing.
            // Prevented close button from working. Would only work after 2nd tap.
            var $sub = $element.parent();
            if ($sub.hasClass('active')) {
                return;
            }

            // Hide all other instances.
            $('.sub', that.element)
                .removeClass('active')
                .find('.sub1')
                .not($element)
                .hide();

            // Show menu.
            $sub.addClass('active');
            $('.sub1', $sub).stop().fadeIn(); // Use stop to avoid overlapping animations.
        },

        _hide: function() {
            var that = this;

            $('.sub1', that.element).stop().fadeOut(function() {
                $(this).parent('.sub').removeClass('active');
            });
        },

        _destroy: function () {
            var that = this;

            $('.sub', that.element).removeClass('active');
            that.element.off('mouseleave').off('click');
            // Remove top menu hoverIntent events.
            $('.sub > h3', that.element).hoverintentresponsive('destroy');
            this.element.removeClass('desktop');
        }

    });
}(jQuery));