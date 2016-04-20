/*
 swatch - JQuery swatch widget. Short term solution until Magento upgrade with out-of-the-box swatch functionality implemented.

 Dependencies:
    equalize.js
*/

(function ($) {
    'use strict';
    $.widget('aydus.swatch', {

        attributeProductMap: null,

        options: {
        },

        _create: function() {
            var that = this;

            // Init attribute product mapping.
            that._setMap();
            // Show swatch buttons.
            this._show();
            // Attach/process swatch button events.
            this._attach();
            // Set default swatch button.
            this._default();
        },

        // Show swatch buttons. Build from default product page select.
        _show: function() {
            var that = this;

            var html = $('<ul class="swatch-wrapper"/>');
            $('select option', that.element).each(function (index) {
                var value = $(this).attr('value');
                var name = that._removePriceModifier($(this).text());
                var safeName = that._makeSafe(name);

                if (value > 0) {
                    html.append('<li class="swatch" value="' + value + '" name="' + name + '" safe-name="' + safeName + '"><span>' + that._getDisplayName(name) + '</span></li>');
                }
            });
            this.element.after(html);
            that._resize(this.element.parent());
        },

        // Size swatches to be the same max width.
        _resize: function($container) {

            $(window).load(function() {
                var $swatches = $('.swatch span', $container);
                var maxWidth = Math.max.apply(null, $swatches.map(function () {
                    return $(this).width();
                }).get());
                $swatches.width(maxWidth);
            });
        },

        // Process swatch events. Special call to prototype function in aydus.swatch.js (needed to fire Magento standard prototype change event).
        _attach: function() {
            var that = this;

            this.element.parent().on('click', '.swatch', function () {
                var value = $(this).attr('value');
                var name = $(this).attr('name');
                if (value > 0) {

                    var $select = $('select', this.element);
                    $select.find($('option[value="' + value + '"]')).prop('selected', 'true'); // Change select option in standard Magento hidden select.
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');
                    aydusSwatchTriggerEvent($select.attr('id')); // Trigger prototype change event (to switch price).
                    that._setContent();
                    that._setImage(name);
                }
            });
        },

        // Map attributes to child products.
        // i.e. that.attributeProductMap['powder'] = 572;
        // spConfig is a Magento global js variable initialized here: app/design/frontend/base/default/template/catalog/product/view/type/options/configurable.phtml
        // Traverse this structure to pull just the mapping data needed (for easy lookup).
        _setMap: function() {
            var that = this;

            that.attributeProductMap = new Object();
            for (var attributeId in spConfig.config.attributes) {
                var attribute = spConfig.config.attributes[attributeId];

                for (var i=0; i < attribute.options.length; i++) {
                    var option = attribute.options[i];
                    var attributeName = that._makeSafe(option.label);
                    var productId = option.products[0];

                    that.attributeProductMap[attributeName] = productId;
                };
            }
        },

        // Get swatch button name to display.
        _getDisplayName: function(name) {

            var nameParts = name.split('|');
            var htmlName = nameParts[0];
            for (var i=1; i < nameParts.length; i++) {
                htmlName += '<span>' + nameParts[i] + '</span>'
            }
            return htmlName;
        },

        // Set image when swatch button changed.
        _setImage: function(name) {
            var that = this;

            name = that._makeSafe(name);
            $('.thumb-link[swatch-value="' + name + '"]').show();
            $('.thumb-link[swatch-value!="' + name + '"]').hide();
            var index = that._getImageIndex();

            $('.product-image-thumbs .thumb-link:visible').eq(index).trigger('click');
        },

        // Set default swatch button based on querystring (or first option).
        _default: function() {
            var that = this;

            var defaultOption = _helper.getQueryString('opt');
            if (defaultOption !== undefined && defaultOption.length > 0) {
                $('.swatch-wrapper .swatch[safe-name="' + defaultOption + '"]').trigger('click');
            }
            else {
                $('.swatch-wrapper .swatch').first().trigger('click');
            }
        },

        // Make attribute name url safe e.g. Tablet Large = tablet-large
        _makeSafe: function(name) {
            var that = this;

            if (name.length > 0) {
                name = name.split('|')[0].trim();
                name = that._removePriceModifier(name);
                name = name.toLowerCase();
                name = _helper.replaceAll(name, ' ', '-');
            }
            return name;
        },

        // Remove price modifier from (as displayed in select control).
        _removePriceModifier: function(s) {
            return s.replace(/\+([^+]+)$/, '').trim();
        },

        // Get index of image to switch to.
        _getImageIndex: function() {
            var activeImageIndexId = $('.product-image-gallery img.visible').attr('id');
            var activeImageIndex = activeImageIndexId.split('-')[1];

            if ('main' == activeImageIndex) {
                activeImageIndex = 0;
            }

            var optionsCount = $('select option', this.element).length - 1;
            var imageThumbsCount = $('.product-image-thumbs a').length;
            var mod = imageThumbsCount /optionsCount;

            return activeImageIndex % mod;
        },

        // Set/toggle content. Product name suffix. Size description.
        _setContent: function() {
            var that = this;

            var $container = $('#product_addtocart_form');
            var $activeSwatch =  $('.swatch.active', $container);

            // Toggle product name suffix.
            var name = $activeSwatch.attr('name');
            name = '(' + name.split('|')[0].trim() + ')';
            $('.product-type', $container).text(name);

            // Toggle product size description.
            var safeName = $activeSwatch.attr('safe-name');
            var childProductId = that.attributeProductMap[safeName];
            $('.product-size', $container)
                .find('span').hide().end()
                .find('span[data-product-id="' + childProductId + '"]').show();
        }

    });
}(jQuery));