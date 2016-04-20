/*
 matchheight - JQuery plugin to match responsive element heights (with optional media query).
 */

(function ($) {
    $.fn.matchheight = function (mq, sw) {

        $.fn.matchheight.count = $.fn.matchheight ? $.fn.matchheight + 1 : 1;
        var curr = $.fn.matchheight.count;
        var _this = this;
        sw = sw === undefined ? true : sw;

        function match(m, s) {
            var run = m ? Modernizr.mq(m) : true;
            if (!s) {
                run = !run;
            }
            if (run) {
                var maxHeight = 0;
                _this.each(function () {
                    maxHeight = $(this).css('height', 'auto').height() > maxHeight ? $(this).height() : maxHeight;
                });
                _this.css('height', maxHeight);
            } else {
                _this.css('height', 'auto');
            }
        };

        $(window).on('throttledresize.aydusmatchheight:' + curr, function () {
            match(mq, sw);
        });

        _this.destroy = function () {
            _this.css('height', 'auto');
            $(window).off('throttledresize.aydusmatchheight:' + curr);
        };

        match(mq, sw);
        return this;
    };
})(jQuery);