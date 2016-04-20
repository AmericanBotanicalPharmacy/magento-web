/*
 addtocart - JQuery ajax add to cart.

 Usage:

    Call addtocart on a container (typically document.body). All add to cart buttons in the container will be wired for ajax add to cart.
    Specify block name / selector pairs to update elements on the page.  e.g. cart count, mini cart etc.
    Specify easy ajax custom block name / selector pairs to update the add to cart dialog. e.g. upsells

    Example call to update mini cart and append featured products upsell.

     $(document.body).addtocart({
        actionContent: [['topCart', '.block-cart']],
        customContent: [['addtocartFeaturedProducts', '#addtocart-container']]
     });

     Widget triggers the following events (passing dialog as data):
        added - called after a successful add to cart (but before dialog content is displayed)
        loaded - called after dialog content is successfully displayed.

     If upsell content added to dialog contains add to cart buttons then bind these these on the loaded event.  e.g.

     $(document.body).bind('addtocartloaded', function(event, data) {
        data.dialog.addtocart({
            actionContent: [['topCart', '.block-cart']],
            customContent: [['addtocartFeaturedProducts', '#addtocart-container']]
        });
     });

 Requires:
     easy ajax third party magento extension
     ajax error aydus extension
     aydus.helper.js
 */

(function ($) {
    'use strict';

    $.widget('aydus.addtocart', {

        dialog: null,

        options: {
            showDialog: true,
            dialogId: 'addtocart-dialog-container',
            actionContent: [],
            customContent: []
        },

        _create: function () {
            var that = this;

            $('.btn-cart[onclick*="cart/add"], .btn-cart[onclick*="productAddToCartForm"]', that.element).prop('onclick', null).click(function(e) {

                // JS variable productAddToCartForm is standard Magento and defined on the product page e.g. var productAddToCartForm = new VarienForm('product_addtocart_form');
                // Call validate before adding to cart.  If not valid, do not process add to cart.
                if (typeof(productAddToCartForm) != 'undefined' && !productAddToCartForm.validator.validate()) {
                    e.preventDefault();
                    return;
                }

                var url = '';
                var data = '';

                // Get add to cart url from button if onclick event has setLocation function.
                var urlRegEx = /'(https?.*)'/i;
                var urlMatch = urlRegEx.exec($(this).attr('onclick'));
                if (urlMatch) {
                    url = urlMatch[1];
                }

                // Get add to cart url on form (if not on button).
                if (url.length == 0) {
                    var $form = $(this).closest('form');
                    if ($form) {
                        url = $form.attr('action');
                        data = $form.serialize();
                    }
                }

                // If form data is blank then add product id parameter from url.
                if (data.length == 0) {
                    var productIdRegEx = /product\/(\d+)/i;
                    var productIdMatch = productIdRegEx.exec(url);
                    if (productIdMatch) {
                        data += 'product=' + productIdMatch[1];
                        data += '&qty=1'; // Default quantity = 1
                    }
                }

                // Add easy ajax parameter to process url and return json.
                if (data.length > 0) {
                    data += '&';
                }
                data += 'easy_ajax=1';

                // Add any action content parameters. EasyAJAX will return html for block names returned by the page.
                // Use custom content parameters, for block names that are not returned by the page.
                for (var i=0; i < that.options.actionContent.length; i++) {
                    data += '&action_content[' + i + ']=' + that.options.actionContent[i][0];
                }

                // If add to cart url then call ajax add to cart.
                if (url.length > 0) {

                    // Disable form submit.
                    e.preventDefault();

                    var productId = parseInt(that._getQueryString(data, 'product'));
                    var qty = parseInt(that._getQueryString(data, 'qty'));

                    // Display add to cart ajax indicator.
                    if (that.options.showDialog) {
                        that._show();
                    }

                    $.ajax({
                        type: 'post',
                        url: url,
                        data: data,
                        success: function (data) {
                            if (data.hasOwnProperty('d')) { data = data.d; }

                            if (that.options.showDialog) {
                                that._load(data, productId, qty);
                            }
                            else {
                                that._hideMessage();  // Hide message (if exists) generated from last add to cart.
                                that._showMessage(data);
                            }

                            _helper.easyAjaxUpdateContent('action', that.options.actionContent, data, 'replaceWith');

                            // Trigger 'added' event if add to cart successful.
                            if (data.messages && data.messages[0].type == 'success') {
                                that._trigger('added', null, {dialog: $('#' + that.options.dialogId)});
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            $.post('ajaxerror/log/' + '?file=' + that.namespace + '.' + that.widgetName + '.js' + '&error=' + XMLHttpRequest.responseText);
                        }
                    });
                }
            });

            // Close dialog with esc key.
            $(document).keydown(function (e) {
                if (e.which == 27) { // escape
                    that._close();
                }
            });
        },

        _destroy: function () {
        },

        // Show add to cart notification (and ajax indicator).
        _show: function () {
            var that = this;
            
            // Close any existing dialog.
            that._close();

            // Main dialog html with ajax indicator.
            that.dialog = $('<div id="' + that.options.dialogId + '" style="display: none;"><div class="close top"></div><div class="ajax">Adding to cart ...</div></div>');

            that.dialog.jqm({
                modal: false,
                overlay: 60,
                closeClass: 'close'
            });

            $('body').append(that.dialog);
            that.dialog.fadeIn('slow');

            // Position dialog center of window. Element centering cross device is problematic.
            that.dialog.position({
                of: $(window),
                my: 'center center',
                at: 'center center',
                collision: 'none'
            });

            that.dialog.on('click', '.close', function () {
                that._close();
            });

            that.dialog.jqmShow();
        },

        _load: function (data, productId, qty) {
            var that = this;
            var $messages = data.messages;

            if ($messages && $messages[0].type == 'success')
            {
                var message = $messages[0].code;
                var data = 'easy_ajax=1&product_id=' + productId + '&qty=' + qty + '&message=' + message;

                // Add any custom content parameters. EasyAJAX will return html for block names that are NOT returned by the page.
                // Use action content parameters, for block names that ARE returned by the page.
                for (var i=0; i < that.options.customContent.length; i++) {
                    data += '&custom_content[' + i + ']=' + that.options.customContent[i][0];
                }

                // Get addtocart root block.
                data += '&custom_content[' + that.options.customContent.length + ']=root';

                $.ajax({
                    type: 'post',
                    url: '/addtocart/index/index',
                    data: data,
                    success: function (data) {
                        if (data.hasOwnProperty('d')) { data = data.d; }

                        that.dialog.html(data.custom_content_data['root']);
                        _helper.easyAjaxUpdateContent('custom', that.options.customContent, data, 'append');
                        that._trigger('loaded', null, {dialog: $('#' + that.options.dialogId)});
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $.post('ajaxerror/log/' + '?file=' + that.namespace + '.' + that.widgetName + '.js' + '&error=' + XMLHttpRequest.responseText);
                    }
                });
            }
            // Handle add to cart error.
            else {
                var message = '<div class="error">' + $messages[0].code + '</div>';
                $('.ajax', that.dialog).remove();
                that.dialog.append(message);
            }
        },

        _close: function () {
            var that = this;

            if (that.dialog) {
                that.dialog.jqmHide();
                that.dialog.remove();
            }
        },

        _showMessage: function(data) {
            var that = this;
            var $messages = data.messages;

            if ($messages && $messages[0].type == 'error') {
                var html = '<ul class="messages"><li class="error-msg"><ul><li><span>' + $messages[0].code + '</span></li></ul></li></ul>';
                $('#messages_product_view').css('display', 'none').html(html).fadeIn();
             }
        },

        _hideMessage: function() {
            $('#messages_product_view').fadeOut();
        },

        // Get query string key value.
        _getQueryString: function(query, key) {
            
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == key) {
                    return pair[1];
                }
            }
        }

    });
}(jQuery));

