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

            var html = '<h1>PRIVACY POLICY & DISCLAIMER</h1><h2>Please read and scroll down to accept or decline</h2><p>Dr. Richard Schulze recognizes that personal decisions about creating powerful health are among the most important private decisions people can make. It is our purpose to protect the privacy that the community of people seeking natural healing expects. By entering this part of the web site, you are seeking and communicating about private issues regarding your health.</p><p>The health suggestions and opinions expressed by Dr. Richard Schulze in this website are based on his 30 years of clinical practice assisting thousands of patients to heal themselves.</p><p>Warning: his knowledge and experience are not necessarily shared, nor have they been evaluated or approved by the F.D.A., the A.M.A., or any other 3-lettered federal, state, local or private agency. With regard to any dietary substances discussed herein, we are required to state in accordance with DSHEA, the Dietary Health and Education Act of 1994, "These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure or prevent any disease."</p><p>Dr. Schulze discusses therapies and products that may have benefit which are not offered to diagnose or prescribe for medical or psychological conditions nor to claim to prevent, treat, mitigate or cure such conditions, nor to make recommendations for treatment of disease or to provide diagnosis, care, treatment or rehabilitation of individuals, or apply medical, mental health or human development principles.</p><p>Therefore, if you are ill, have any disease, are pregnant, or just improving your health, we are required to warn you to go to a medical doctor for medical advice, treatment and services.</p><p>Upon entering and/or purchasing from this site, you hereby agree to take full responsibility for yourself, your health and release, indemnify and hold harmless, Dr. Richard Schulze, American Botanical Pharmacy, Natural Healing Publications, their employees and heirs. You are entering a community for natural healing and seeking information and products based on those principles thereby granting a private license to the above to provide you the information herein.</p><p>All written material and images copyrighted 2008. Many people have been unscrupulous and misused Dr. Schulze\'s copyrighted material and images to mislead the public and sell them inferior products that may have made people sick or even die. Therefore, we are very serious about enforcing our copyright infringement policies to help protect the health and well-being of our customers.</p><p>If you agree with all of the above, and if you are acting as a private person without subterfuge or as a public agent, you may enter and/or purchase from this web site.</p><div class="button-container"><a href="#" class="accept blink1">I ACCEPT</a><a href="#" class="decline blink2">I DECLINE</a></div>';
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