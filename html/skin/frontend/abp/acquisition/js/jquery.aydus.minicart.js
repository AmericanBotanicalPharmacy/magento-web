/*
 minicart - JQuery mini cart widget to ajax magento mini cart.
*/

(function ($) {
    'use strict';
    $.widget('aydus.minicart', {

        autoTimer: null,

        options: {
            container: '#header-cart',
            autoHide: 0
        },

        _create: function () {
            var that = this;

            // Remove default Magento events.
            $('.skip-link').off('click');
            $('#header-cart').off('click', '.skip-link-close');

            // Attach event to parent. that.element replaced as part of ajax call and direct bound events are lost.
            that.element.parent().on('click', '.menu-cart', function(e) {
                if (!$(this).parent().hasClass('active')) {
                    that.show();
                }
                else {
                    that.hide();
                }
                e.preventDefault();
            });

            // Attach event to parent. that.element replaced as part of ajax call and direct bound events are lost.
            that.element.parent().on('click', '.close', function() {
                that.hide();
            });

            // Add class = mouse when mouse is over minicart e.g. do not close if customer mouse over cart.
            // Attach event to parent. that.element replaced as part of ajax call and direct bound events are lost.
            that.element.parent()
                .on('mouseenter', that.options.container, function(e) {
                    that.element.addClass('mouse');
                })
                .on('mouseleave', that.options.container, function(e) {
                    that.element.removeClass('mouse');
                    that.autoHide();
            });

            // Custom addtocart plugin trigger. When item successfully added to cart, show minicart.
            $(document.body).on('addtocartadded', function(event, data) {
                that.show();
            });

            // If header cart not 100% visible in viewport then set class accordingly.
            $(window).on('scroll.' + that.widgetName, function (e) {
                that._scroll();
            });
        },

        show: function() {
            var that = this;

            // If scrolled down page, show mini cart fixed.
            that._scroll();

            $(that.options.container).slideDown('slow', function() {
                $(this).parent().addClass('active');
            });

            // If auto hide then set timer to hide.
            if (that.options.autoHide > 0) {
                that.autoHide();
            }
        },

        hide: function() {
            var that = this;
            $(that.options.container).slideUp('slow', function() {
                $(this).parent().removeClass('active');
            });
        },

        autoHide: function() {
            var that = this;

            clearTimeout(that.timer);
            that.timer = setTimeout(function() {
                if (!that.element.hasClass('mouse')) {
                    that.hide();
                }
            }, that.options.autoHide);
        },

        _showOverlay: function() {
            var that = this;
            $('.minicart-wrapper', that.element).addClass('loading');
        },

        _hideOverlay: function() {
            var that = this;
            $('.minicart-wrapper', that.element).removeClass('loading');
        },

        // If header cart not 100% visible in viewport then toggle undocked class.
        _scroll: function() {
            var that = this;
            var inScrollView = _helper.isScrollView(that.element);
            $(that.options.container).toggleClass('undocked', !inScrollView);
        }

        /*
        // Do not use. Incomplete. Destroy fires early and minicart does not open.
        _destroy: function () {
            var that = this;

            that.element.parent()
                .off('click')
                .off('mouseenter')
                .off('mouseleave');

            $(document.body).off('addtocartadded');
            $(window).off('scroll.' + that.widgetName); // Unbind namespaced scroll event.
        }
        */
    });
}(jQuery));