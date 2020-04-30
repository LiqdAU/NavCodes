(function($) {

    window.navCodes = {

        smoothScroll: function( target, event ) {
            target = $( target );
            if( target.length ) {
                if (typeof event === 'object') {
                    event.preventDefault();
                }
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - $('header').height() - 62
                }, 1000);
            }
        },

        quicklinks: {

            generate: function() {

                let $quicklinks = $('.navcodes-quicklinks'),
                $headings = $('h1[id], h2[id], h3[id], h4[id], h5[id]');

                $headings.each(function() {
                    let title = $(this).text(),
                    id = $(this).attr('id');

                    $quicklinks.append(`<li><a href="#${id}" class="navcodes-item">${title}</a></li>`);
                });

            }

        }

    };

    // Generate Quicklinks
    $(document).ready( navCodes.quicklinks.generate );

    // Hook anchor clicks to smooth scroll
    $(document).on('click', 'a[href^="#"]', function(e) { navCodes.smoothScroll( this.getAttribute('href'), e ); });

    // Hook hashchange event to smooth scroll
    $(window).on('hashchange', function(e) { navCodes.smoothScroll( window.location.hash, e ); });

    // Hook page load with hash to smooth scroll
    $(window).load( function(e) { if (window.location.hash.length > 0) { navCodes.smoothScroll( window.location.hash ); } });

})(jQuery);
