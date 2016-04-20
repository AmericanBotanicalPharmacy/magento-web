/*
 newslettersubscribe - JQuery ajax newsletter subscribe widget. i.e. makes magento newsletter subscribe ajax enabled.
 */

(function ($) {
    'use strict';
    $.widget('aydus.newslettersubscribe', {

        options: {
            actionContent: [[],[]],
            customContent: [[],[]]
        },

        _create: function() {
            var that = this;

            $('.button', that.element).prop('onclick', null).click(function(e) {

                var formUrl = '';
                var formData = '';

                $('.newsletter-messages', that.element).remove();

                var $form = $(this).closest('form');
                if ($form) {
                    formUrl = $form.attr('action');
                    formData = $form.serialize();
                }

                // Add easy ajax parameter to process url and return json.
                formUrl += '?easy_ajax=1';

                // Add any action content parameters. EasyAJAX will return html for block names returned by the page.
                // Use custom content parameters, for block names that are not returned by the page.
                for (var i=0; i < that.options.actionContent.length; i++) {
                    formData += '&action_content[' + i + ']=' + that.options.actionContent[i][0];
                }

                // Add any custom content parameters. EasyAJAX will return html for block names that are NOT returned by the page.
                // Use action content parameters, for block names that ARE returned by the page.
                for (var i=0; i < that.options.customContent.length; i++) {
                    formData += '&custom_content[' + i + ']=' + that.options.customContent[i][0];
                }

                // If subscribe url then call ajax newsletter subscribe.
                if (formUrl.length > 0) {

                    // Disable form submit.
                    e.preventDefault();

                    $.ajax({
                        type: 'post',
                        url: formUrl,
                        data: formData,
                        success: function (data) {
                            if (data.hasOwnProperty('d')) { data = data.d; }

                            var messages = data.messages;
                            var messageType = messages[0].type;
                            var message = messages[0].code;

                            var html = '<ul class="newsletter-messages"><li class="newsletter-' + messageType + '-msg"><ul><li><span>' + message + '</span></li></ul></li></ul>';
                            var $actions = $('.actions', that.element);
                            if ($actions.length) {
                                $('.actions', that.element).before(html);
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            $.post('ajaxerror/log/' + '?file=' + that.namespace + '.' + that.widgetName + '.js' + '&error=' + XMLHttpRequest.responseText);
                        }
                    });
                }
            });
        }

    });
}(jQuery));

/*
 newslettersubscribe 1.0.0 - JQuery ajax newsletter subscribe plugin. i.e. makes magento newsletter subscribe ajax enabled.

 Requires:
 EasyAjax plugin

 Copyright (c) Aydus (www.aydus.com)
 that._trigger('submit', null, {messageType: messageType});
 */

/*
(function ($) {

    var settings = {
        actionContent: [[],[]],
        customContent: [[],[]]
    };

    var methods = {
        init: function (options) { if (options) { $.extend(settings, options); } return init(this, settings); }
    };

    $.fn.newslettersubscribe = function (method) {
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
        return object.each(function () {
            var $object = $(this);

            $('.button', $object).prop('onclick', null).click(function(e) {

                var formUrl = '';
                var formData = '';

                $('.newsletter-messages', $object).remove();

                var $form = $(this).closest('form');
                if ($form) {
                    formUrl = $form.attr('action');
                    formData = $form.serialize();
                }

                // Add easy ajax parameter to process url and return json.
                formUrl += '?easy_ajax=1';

                // Add any action content parameters. EasyAJAX will return html for block names returned by the page.
                // Use custom content parameters, for block names that are not returned by the page.
                for (var i=0; i < that.options.actionContent.length; i++) {
                    formData += '&action_content[' + i + ']=' + that.options.actionContent[i][0];
                }

                // Add any custom content parameters. EasyAJAX will return html for block names that are NOT returned by the page.
                // Use action content parameters, for block names that ARE returned by the page.
                for (var i=0; i < that.options.customContent.length; i++) {
                    formData += '&custom_content[' + i + ']=' + that.options.customContent[i][0];
                }

                // If subscribe url then call ajax newsletter subscribe.
                if (formUrl.length > 0) {

                    // Disable form submit.
                    e.preventDefault();

                    $.ajax({
                        type: 'post',
                        url: formUrl,
                        data: formData,
                        success: function (data) {
                            if (data.hasOwnProperty('d')) { data = data.d; }

                            var messages = data.messages;
                            var messageType = messages[0].type;
                            var message = messages[0].code;

                            var html = '<ul class="newsletter-messages"><li class="newsletter-' + messageType + '-msg"><ul><li><span>' + message + '</span></li></ul></li></ul>';
                            var $actions = $('.actions', $object);
                            if ($actions.length) {
                                $('.actions', $object).before(html);
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            //alert(XMLHttpRequest.responseText);
                        }
                    });
                }
            });
        });
    }

})(jQuery);
*/