(function($) {

    window.navCodes = {

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

    $(document).ready(navCodes.quicklinks.generate);
    $(document).on('click', 'a[href^="#"]', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - $('header').height() - $('#wpadminbar').height() - 30
            }, 1000);
        }
    });

})(jQuery);
