/*
 cmslightbox - JQuery cmslightbox widget. Open cms static block in lightbox.

 Requires:
    - magnific-popup jquery plugin.
*/

(function ($) {
    'use strict';
    $.widget('aydus.cmslightbox', {

        options: {
            cmsIdentifier: '',
            containerClassName: 'content-container',
            autoOpen: false,
            modal: false,
            closeSelector: ''
        },

        _create: function() {
            var that = this;

            // Get CMS static block identifier.  Get from data element on container element.
            var cmsIdentifier = that.element.data('identifier');

            // If identifier does not exist, get from options.
            if (typeof cmsIdentifier == 'undefined' || cmsIdentifier.length == 0) {
                cmsIdentifier = that.options.cmsIdentifier;
            }

            // If identifier does not exist, exit.
            if (typeof cmsIdentifier == 'undefined' || cmsIdentifier.length == 0) {
                return;
            }

            var html = '<div class="' + that.options.containerClassName + '">' + html + "</div>";

            var magnificPopupContainer = that.element;
            if (that.options.autoOpen) {
                magnificPopupContainer = $;
            }

            var mainClass = that.widgetName + ' ' + _helper.replaceAll(cmsIdentifier, '_', '-');
            var src = '/ajaxcms/block/?identifier=' + cmsIdentifier;
            var tLoading = '';

            // Create lightbox instance.
            if (that.options.autoOpen) {

                $.magnificPopup.open({
                    mainClass: mainClass,
                    type: 'ajax',
                    items: {
                        src: src
                    },
                    callbacks: {
                        open: function() {
                            that._callbackOpen();
                        },
                        parseAjax: function(mfpResponse) {
                            mfpResponse.data = that._parseAjax(mfpResponse);
                        }
                    },
                    modal: that.options.modal,
                    closeOnContentClick: false,
                    tLoading: tLoading
                });
            }
            else {

                that.element.magnificPopup({
                    mainClass: mainClass,
                    type: 'ajax',
                    items: {
                        src: src
                    },
                    callbacks: {
                        open: function() {
                            that._callbackOpen();
                        },
                        parseAjax: function(mfpResponse) {
                            mfpResponse.data = that._parseAjax(mfpResponse);
                        }
                    },
                    modal: that.options.modal,
                    closeOnContentClick: false,
                    tLoading: tLoading
                });
            }
        },

        // Change ajax data before render.
        _parseAjax: function(mfpResponse) {
            var that = this;

            // Wrap data in div container for styling.
            return '<div class="' + that.options.containerClassName + '">' + mfpResponse.data + '</div>';
        },

        // Content is loaded into DOM. Attach events.
        _callbackOpen: function() {
            var that = this;

            // Attach custom close selectors.  e.g. content can contain a close button or link.
            if (that.options.closeSelector.length > 0) {
                $('.' + that.widgetName).on('click', that.options.closeSelector, function(e) {
                    that.element.magnificPopup('close');
                    e.preventDefault();
                });
            }
        }
    });
}(jQuery));