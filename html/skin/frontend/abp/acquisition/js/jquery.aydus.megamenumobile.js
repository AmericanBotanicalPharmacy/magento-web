/*
 megamenumobile - JQuery lite mobile mega menu.
*/

(function ($) {
    'use strict';
    $.widget('aydus.megamenumobile', {

        _create: function() {
            var that = this;

            enquire.register(_responsive.mqMobile, {
                match: function() {
                    that.element.addClass('mobile');
                },
                unmatch: function() {
                    that.element.removeClass('mobile');
                }
            });

            // Mobile, show sub menu on parent menu click.
            that.element.on('click', 'h3, h4', function(e) {
                // Mobile, do not activate menu collapse/expand on anchor click.
                if ('A' != $(e.originalEvent.srcElement).prop('tagName')) {
                    $(this).toggleClass('expanded');
                    $(this).closest('li').toggleClass('expanded');
                }
                e.stopPropagation();
            });

            that.element.on('click', function() {
                if (!$(this).hasClass('active')) {
                    that._show();
                }
                else {
                    that._hide();
                }
            });
        },

        _show: function() {
            var that = this;

            $('> ul', that.element).slideDown(300);
            that.element.addClass('active');
        },

        _hide: function() {
            var that = this;

            $('> ul', that.element).slideUp(300);
            that.element.removeClass('active');
        },

        _destroy: function () {
            var that = this;

            that.element.removeClass('active');
            that.element.off('click');
        }

    });
}(jQuery));