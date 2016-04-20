/*
 emailsignup - JQuery email signup dialog.
*/

(function ($) {
    'use strict';
    $.widget('aydus.emailsignup', {

        options: {
            cookieName: 'email_signup',
            subscribeSubmitEvent: 'newslettersubscribesubimt' //mailchimpsubscribesubmit
        },

        _create: function() {
            var that = this;

            that.element.jqm({
                modal: false,
                overlay: 60
            });

            // Attach close elements to close method.
            that.element.on('click', '.close', function () {
                that.close();
            });
            
            // Attach button to submit button.
            that.element.on('click', '.blink', function () {
                $('button', that.element).trigger('click');
            });

            // Close dialog with esc key.
            $(document).keydown(function (e) {
                if (e.which == 27) { // escape
                    that.close();
                }
            });
            // Bind to the custom submit event (fired by newsletter subscribe widget) to determine if signup successful (or not).
            $(document.body).bind(that.options.subscribeSubmitEvent, function(event, data) {

                // If subscription successful then hide dialog.
                /*var messageType = data.messageType;
                if ('success' == messageType) {
                    that.close;
                    $(".signup-form").fadeOut();
                    $(".success-copy").html('<p>Thank you for your subscription.</p>');
                }*/
            });

            that.show();
            that._resize();
            
           
        },

        // Re-position dialog in middle of screen on window resize.
        _resize: function() {
            var that = this;

            $(window).on("debouncedresize", function( event ) {
                that.element.position({
                    of: $(window),
                    my: 'center center',
                    at: 'center center',
                    collision: 'none'
                });
            });
        },

        // Show email signup dialog in middle of window.
        // Dialog must be visible prior to calling jquery ui position.
        show: function() {
            var that = this;

            if (that._isShow()) {

                that.element.fadeIn('slow');
                that.element.position({
                    of: $(window),
                    my: 'center center',
                    at: 'center center',
                    collision: 'none'
                });

                that.element.jqmShow();
            }
        },

        // Close/hide dialog.
        close: function () {
            var that = this;

            if (that.element.length) {
                that.element.jqmHide();
            }
        },

        // Return true if email subscribe cookie is not already set.
        _isShow: function() {
            var that = this;

            var returnValue = false;
            var domain = window.aydus.jdata.shortUrl;
            var isCookiesEnabled = _helper.isCookiesEnabled(domain);

            // If cookies enabled and dialog cookies not set, then set cookie and return true (to show dialog).
            if (isCookiesEnabled && $.cookie(that.options.cookieName) != '1') {
                $.cookie(that.options.cookieName, '1', { expires: 3650, path: '/', domain: domain, secure: false });
                returnValue = true;
            }
            return returnValue;
        }
    });
}(jQuery));