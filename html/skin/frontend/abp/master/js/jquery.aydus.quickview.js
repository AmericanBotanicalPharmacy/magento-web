/*
 quickview - JQuery quickview dialog.

 Requires:
 jQuery position utility
 jqModal plugin
 EasyAjax plugin
 */

(function ($) {
    'use strict';
    $.widget('aydus.quickview', {

        dialog: null,

        options: {
            dialogId: 'quickview-dialog-wrapper',
            actionContent: [],
            customContent: [['quick.view.wrap', '#quickview-dialog-wrapper']]
        },

        _create: function () {
            var that = this;

            that.element.click(function(e) {
                e.preventDefault();

                var productId = parseInt(that.element.data('product-id'));
                if (productId > 0) {
                    that.show(productId);
                }
            });

            // Custom addtocart plugin trigger. When item successfully added to cart, show minicart.
            $(document.body).on('addtocartadded', function(event, data) {
                that.close();
            });
        },

        show: function (productId) {
            var that = this;

            // Close any existing quick view (across all widget instances).
            $(':aydus-quickview').quickview('close');

            // Main dialog html with ajax indicator.
            that.dialog = $('<div id="' + that.options.dialogId + '" style="display: none;"><div class="close top"></div><div class="ajax"</div></div>');

            // Prepend into parent container.
            $(document.body).append(that.dialog);
            that.dialog.fadeIn('slow');

            // Position dialog center of window. Use CSS to make responsive.
            var my = 'center center';
            var at = 'center center';
            // If mobile position top of window.
            if (Modernizr.mq(_responsive.mqMobile)) {
                my = 'center top';
                at = 'center top';
            }
            that.dialog.position({
                of: $(window),
                my: my,
                at: at,
                collision: 'none'
            });

            // Trigger widget show event.
            that._trigger('show');

            // Load html.
            that._load(productId);

            that.dialog.on('click', '.close', function () {
                that.close();
            });

            // Close dialog with esc key.
            $(document).keydown(function (e) {
                if (e.which == 27) { // escape
                    that.close();
                }
            });
        },

        close: function () {
            var that = this;

            if (that.dialog !== null) {
                //that.dialog.hide(); /* IE7, IE8 */
                this.dialog.jqmHide();
                that.dialog.remove();

                // Trigger widget close event.
                that._trigger('close');
            }
        },

        _load: function(productId) {
            var that = this;

            var data;

            // Add easy ajax parameter to process url and return json.
            data = 'easy_ajax=1';

            // Add any action content parameters. EasyAJAX will return html for block names returned by the page.
            // Use custom content parameters, for block names that are not returned by the page.
            for (var i=0; i < this.options.actionContent.length; i++) {
                data += '&action_content[' + i + ']=' + this.options.actionContent[i][0];
            }

            // Add any custom content parameters. EasyAJAX will return html for block names that are NOT returned by the page.
            // Use action content parameters, for block names that ARE returned by the page.
            for (var i=0; i < this.options.customContent.length; i++) {
                data += '&custom_content[' + i + ']=' + this.options.customContent[i][0];
            }

            $.ajax({
                type: 'post',
                url: '/catalog/product/view/id/' + productId,
                data: data,
                success: function (data) {
                    if (data.hasOwnProperty('d')) { data = data.d; }

                    that._updateCustomContent(data);
                    that._trigger('loaded', null, {dialog: $('#' + that.options.dialogId)});
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $.post('ajaxerror/log/' + '?file=' + that.namespace + '.' + that.widgetName + '.js' + '&error=' + XMLHttpRequest.responseText);
                }
            });
        },

        _updateActionContent: function(data) {

            for (var i=0; i < this.options.actionContent.length; i++) {
                var blockName = this.options.actionContent[i][0];
                var selector = this.options.actionContent[i][1];
                var html = data.action_content_data[blockName];
                $(selector).html(html);
            }
        },

        _updateCustomContent: function(data) {

            for (var i=0; i < this.options.customContent.length; i++) {
                var blockName = this.options.customContent[i][0];
                var selector = this.options.customContent[i][1];
                var html = data.custom_content_data[blockName];
                $(selector).html(html);
            }
        }

    });
}(jQuery));