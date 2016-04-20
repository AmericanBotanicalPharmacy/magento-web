/*
    JQuery project main widget.
 */

(function($) {
   'use strict';
   $.widget('aydus.abp', {

      _create: function() {
         this.initAllPages();
         this.initHomePage();
         this.initCategoryPage();
         this.initProductPage();
         this.initSearchPage();
         this.initShoppingCartPage();
         this.initCheckoutPage();
         this.initRegisterPage();
         this.initCmsPage();
         this.initStorePage();
         this.initLearnPage();
         this.initBlogPage();
      },

      initAllPages: function() {

         // AJAX add to cart widget.
         if (!Modernizr.mq(_responsive.mqMobile)) {
            $(document.body).addtocart({
               showDialog: false,
               actionContent: [
                  ['minicart_head', '.header-minicart']
               ] // Block/selector to update on add to cart success.
            });
         }

         // Mini cart widget.
         if (!Modernizr.mq(_responsive.mqMobile)) {
            $('.header-minicart').minicart({
               autoHide: 5000
            });
         }

         // Quickview widget.
         $('.quickview').quickview({
            dialogParentSelector: '.story-banner'
         });

         // Bind AJAX add to cart to quickview add to cart button.
         if (!Modernizr.mq(_responsive.mqMobile)) {
            $(document.body).on('quickviewloaded', function(event, data) {
               $(data.dialog).addtocart({
                  showDialog: false,
                  actionContent: [
                     ['minicart_head', '.header-minicart']
                  ] // Block/selector to update on add to cart success.
               });
            });
         }

         // Back To Top
         var btt = $('#back-to-top');
         btt.on('click', function() {
            $('html, body').animate({
               scrollTop: 0
            }, 500);
         });

         $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
               btt.show(400)
            } else {
               btt.hide(400)
            }
         });

         // Feedback radio buttons


         $('.ratings-list li').on('click', function() {
            var id = substring(this.id, 10);
            setRadio(id);
         });

         function setRadio(id) {
            //   var toNum = parseInt(substring(id, 4), 10);
            //   console.log(toNum);
            var radio = $('#' + id);
            //    if (radio.attr('checked') === false) radio.attr('checked', true)
            //    else radio.attr('checked', true);
            //radio[0].checked = true;
            console.log(id, radio);
            //   radio.button("refresh");
            if (id == 77 || id == 78) {
               $('.more').filter(':hidden').show(500);
            } else {
               $('.more').filter(':visible').hide(500);
            }
         }
         /*
         $('input[type="radio"]').on('change', function() {
            $(this).button('refresh');
            var fieldNum = parseInt(this.id, 10);
            if (fieldNum == 77 || fieldNum == 78) {
               $('.more').filter(':hidden').show(500);
            } else {
               $('.more').filter(':visible').hide(500);
            }
         });
*/


         // Set all article heights to auto
         $('.article-container article').css({
            'height': 'auto',
            'max-height': '500px'
         });

         // Home page tabs.
         $(function() {
            $("#section-two-tabs").tabs({
               show: 'fade',
               hide: 'fade'
            });
         });
         $(function() {
            $("#section-three-tabs").tabs({
               show: 'fade',
               hide: 'fade'
            });
         });

         // Toggle megamenu and megamenumobile widgets.
         enquire.register(_responsive.mqMobile, {
            setup: function() {
               $('#megamenu-container').megamenu();
            },
            match: function() {
               $('#megamenu-container').megamenu('destroy');
               $('#megamenu-container').megamenumobile();
            },
            unmatch: function() {
               $('#megamenu-container').megamenumobile('destroy');
               $('#megamenu-container').megamenu();
            }
         });

         $('#search_mini_form2').tabletsearch();

         // On home, store pages. Split section1 ul/li list into columns.
         $('.cms-home .section1 .article3 ul, .cms-store .section1 .article3 ul').cols(2);
         // Make section1 articles same height.
         enquire.register(_responsive.mqIsDesktop, {
            match: function() {
               // Wait for page to load (including images). Images are needed to determine true height of container.
               $(window).load(function() {
                  $('.section1 article').matchheight();
               });
            },
            unmatch: function() {
               $('.section1 article').matchheight('destroy');
            }
         });

         // Make Magento newsletter signup ajax.
         $('.block-subscribe').newslettersubscribe();

         // Hook lightbox video to anchor tags.  e.g. <a class="lightbox-vimeo" href="https://vimeo.com/105924445">Open Vimeo video</a>
         $('.lightbox-vimeo, .lightbox-youtube, .lightbox-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
         });

         // Hook lightbox text to class.
         $('.lightbox-text').cmslightbox({});
      },

      initHomePage: function() {

         if ($('body.cms-index-index').length) {

            // Initialize banner widget.
            $('#banners-container .banners').bannerenhanced();

            // Email Signup Plugin
            /*
                $('#email-signup-container').emailsignup({
                  cookieName: 'abp_email_signup'
                });
                */

            $('.video-wrapper-home .video-home li').click(function() {

               var videoId = $(this).data('video-id');
               var width = $('.video-player-home').width();
               var height = $('.video-player-home').height();
               setVideo(videoId);

               function setVideo(videoId, width, height) {

                  $('.video-player-home').empty().attr('video-id', videoId);
                  $('<iframe/>').attr({
                     src: 'https://player.vimeo.com/video/' + videoId,
                     height: height,
                     width: width,
                     frameborder: 0,
                     webkitallowfullscreen: '',
                     mozallowfullscreen: '',
                     allowfullscreen: ''
                  }).appendTo('.video-player-home');

                  // Make video responsive.
                  $('.video-player-home').fitVids();
               }
            });

            // Initialize player for first video.
            $('.video-wrapper-home .video-home li:first-child').trigger('click');
         }
      },

      initCategoryPage: function() {

         if ($('body.catalog-category-view').length) {}
      },

      initProductPage: function() {

         if ($('body.catalog-product-view').length) {

            // Product content menu links
            $('.product-menu-cms').on('click', 'a', function(e) {
               $.scrollTo($(this).attr('href'), 600, {
                  offset: -100
               });
               e.preventDefault();
            });

            // Switch main product image on thumbnail click.
            $('#product_addtocart_form .product-img-box .more-views a').prop('onclick', null).click(function(e) {
               $('#product_addtocart_form .product-image img').attr('src', $(this).data('src'));
               e.preventDefault();
            });

            // Init related items (people also bought) carousel.
            $('.box-related ol, .box-up-sell ul').addClass('owl-carousel').owlCarousel({
               items: 5,
               navigation: true,
               navigationText: ['', ''],
               scrollPerPage: true,
               itemsMobile: [_responsive.mobileWidth - 1, 1]
            });
         }
      },

      initSearchPage: function() {

         if ($('body.catalogsearch-result-index, body.wordpress-search-index').length) {}
      },

      initShoppingCartPage: function() {

         if ($('body.checkout-cart-index').length) {

            // Expand/collapse coupon code form.
            $('#cart-discount-expander').click(function() {
               if (!$(this).hasClass('active')) {
                  $('.discount', $(this).parent()).slideDown('fast');
                  $(this).addClass('active');
               } else {
                  $('.discount', $(this).parent()).slideUp('fast');
                  $(this).removeClass('active');
               }
            });
            // If coupon applied, then show coupon code form.
            if ($('#coupon_code').val().length > 0) {
               $('#discount-coupon-form .discount').show();
               $('#cart-discount-expander').addClass('active');
            }
         }
      },

      initCheckoutPage: function() {

         if ($('body.checkout-onepage-index').length) {

            // Show privacy policy lightbox on register/guest button click.
            $('#onepage-guest-register-button').cmslightbox({
               cmsIdentifier: 'privacy_policy',
               closeSelector: '.accept',
               modal: true
            });
         }
      },

      initRegisterPage: function() {

         if ($('body.customer-account-create').length) {

            // Show privacy policy lightbox.
            // Lightbox does not work if body or document element used. So main element on page used instead.
            $(document.body).cmslightbox({
               cmsIdentifier: 'privacy_policy',
               closeSelector: '.accept',
               autoOpen: true,
               modal: true
            });
         }
      },

      initCmsPage: function() {

         if ($('body.cms-page-view').length) {}

         $("#ailments-tabs").tabs({
            show: 'fade',
            hide: 'fade'
         });

      },

      initStorePage: function() {

         if ($('body.cms-store').length) {

            // Init related items (people also bought) carousel.
            $('.category-products ul').addClass('owl-carousel').owlCarousel({
               items: 5,
               navigation: true,
               navigationText: ['', ''],
               scrollPerPage: true,
               itemsMobile: [_responsive.mobileWidth - 1, 1]
            });

            // Convert this to widget if requires enhancement.
            $('.video-wrapper .video li').click(function() {

               var videoId = $(this).data('video-id');
               var width = $('.video-player').width();
               var height = $('.video-player').height();
               setVideo(videoId);

               function setVideo(videoId, width, height) {

                  $('.video-player').empty().attr('video-id', videoId);
                  $('<iframe/>').attr({
                     src: 'https://player.vimeo.com/video/' + videoId,
                     height: height,
                     width: width,
                     frameborder: 0,
                     webkitallowfullscreen: '',
                     mozallowfullscreen: '',
                     allowfullscreen: ''
                  }).appendTo('.video-player');

                  // Make video responsive.
                  $('.video-player').fitVids();
               }
            });

            // Initialize player for first video.
            $('.video-wrapper .video li:first-child').trigger('click');
         }
      },

      initLearnPage: function() {

         if ($('body.cms-learn').length) {

            // Init testimonial carousel.
            $('.section2 .column.right ul').addClass('owl-carousel').owlCarousel({
               singleItem: true,
               navigation: true,
               navigationText: ['', '']
            });
         }
      },
      
      initBlogPage: function() {
	      
	
	  
	 }

   });
}(jQuery));