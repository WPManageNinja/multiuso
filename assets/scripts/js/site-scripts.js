(function ($) {
    $(document).ready(function () {

        jQuery(document).foundation();

        // Remove empty P tags created by WP inside of Accordion and Orbit
        jQuery('.accordion p:empty, .orbit p:empty').remove();

        // Adds Flex Video to YouTube and Vimeo Embeds
        jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function () {
            if (jQuery(this).innerWidth() / jQuery(this).innerHeight() > 1.5) {
                jQuery(this).wrap("<div class='widescreen responsive-embed'/>");
            } else {
                jQuery(this).wrap("<div class='responsive-embed'/>");
            }
        });

        $('.off-canvas-burger').click(function () {
            if ($(this).attr('aria-expanded') == 'true') {
                $(this).find('.hamburger').removeClass('is-active')
            } else {
                $(this).find('.hamburger').addClass('is-active')
            }
        });

        $('.js-off-canvas-overlay').click(function () {
            if ($('.off-canvas-burger').attr('aria-expanded') == 'false') {
                $('.off-canvas-burger').find('.hamburger').removeClass('is-active')
            } else {
                $('.off-canvas-burger').find('.hamburger').addClass('is-active')
            }
        });

        if ($('.toppage-carousel').length) {
            $('.toppage-carousel').owlCarousel({
                loop: false,
                margin: 0,
                responsiveClass: true,
                dots: false,
                navText: [
                    '<span class="lnr lnr-chevron-left"></span>', 
                    '<span class="lnr lnr-chevron-right"></span>'
                ],
                responsive: {
                    10: {
                        items: 1,
                        nav: true,
                    }
                },
                onInitialized: counter, //When the plugin has initialized.
                onTranslated: counter //When the translation of the stage has finished.
            });
        }

        function counter(event) {
            var element = event.target;         // DOM element, in this example .owl-carousel
            var items = event.item.count;     // Number of items
            var item = event.item.index + 1;     // Position of the current item
            $('.num').html(item + " / " + items);
            $('.toppage-carousel-wrap').css('background-image', 'url("' + $('.owl-stage-outer .owl-item').eq(event.item.index).find('.item').attr('data-image') + '")')
        }

        // Write code here
        if ($('.cat-carousel').length) {
            $('.cat-carousel').owlCarousel({
                rtl: true,
                loop: true,
                dots: false,
                margin: 30,
                nav: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        }

    });
})(jQuery);


