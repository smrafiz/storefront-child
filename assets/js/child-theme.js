(function ($) {
    jQuery(document).ready(function ($) {
        const pricingWrapper = $(".pricing-wrapper");
        if (pricingWrapper) {
            $(".pricing-wrapper").each(function() {
                $(".pricing-switch-container").on("click", function() {
                    $(".pricing-switch")
                        .parents(".price-switch-box")
                        .toggleClass("price-switch-box--active"),
                        $(".pricing-switch").toggleClass("pricing-switch-active"),
                        $(".rt-tab-content").toggleClass("rt-active");
                });
            });
        }

    });
    $(window).on('load', function () {
        isotop_tab();
    });
    $(window).on('scroll', function() {
        var height = $(window).scrollTop();

        if (height < 140) {
            $('.site-header').removeClass('scrolling');
        } else {
            $('.site-header').addClass('scrolling');
        }
    });
    function isotop_tab(){
        // Isotope
        $('#preloader').fadeIn('slow');
        if (typeof $.fn.isotope == 'function') {
            // Run 1st time
            var $isotopeContainer = $('#inner-isotope');

            setTimeout(function () {
                $isotopeContainer.each(function () {
                    var $container = $(this).find('.featuredContainer'),
                        filter = $(this).find('.isotope-classes-tab a.current').data('filter');
                    runIsotope($container, filter);
                });

                $('#preloader').fadeOut('slow');

                // Run on click event

                $('.isotope-classes-tab a').on('click', function () {
                    $(this).closest('.isotope-classes-tab').find('.current').removeClass('current');
                    $(this).addClass('current');
                    var $container = $(this).closest('.filter-wrapper').siblings('.widgets-wrapper').find('.featuredContainer'),
                        filter = $(this).attr('data-filter');
                    runIsotope($container, filter);
                    return false;
                });

            },1000);

        }
    }
    function runIsotope($container, filter) {
        $container.isotope({
            filter: filter,
            transitionDuration: ".7s",
            hiddenStyle: {
                opacity: 0,
                transform: "scale(0.001)"
            },
            visibleStyle: {
                transform: "scale(1)",
                opacity: 1
            }
        });
    }
    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            elementorFrontend.hooks.addAction('frontend/element_ready/widget', function () {
                isotop_tab();
            });
        }
    });
})(jQuery);