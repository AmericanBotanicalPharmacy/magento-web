/*
 storybanner - JQuery shop the story banner.

 Requires:
    Cycle2 jquery plugin.
 */

(function ($) {
    'use strict';
    $.widget('aydus.bannerenhanced', {

        options: {
        },

        _create: function () {
            var that = this;

            // Add pager and next/prev elements.
            var pager = '<div class="cycle-pager" />';
            var controls = '<div class="cycle-prev navigation"></div><div class="cycle-next navigation"></div>';
            that.element.append(controls + pager);

            // Init cycle2 plugin.
            that.element.cycle({
                fx: 'fade',
                slides: '> li',
                speed: 1000,
                paused: false,
                pauseOnHover: true,
                swipe: true,
                pager: '.cycle-pager',
                pagerTemplate: '<span></span>',
                log: false
            });
        }

    });
}(jQuery));