( function () {

    $( window ).resize( function(e) {

        if( window.innerWidth > 960 ) {

            $('html, body, .header__bottom').removeAttr('style');

        }
        /*else {

            $('.header__bottom').hide();

        }*/

    });

    $( '.menu__link' ).click(function() {

        if( window.innerWidth <= 960 ) {

            if( !( $('.header__bottom').is(':visible') ) ) {

              $('.header__bottom').css({
                'height': window.innerHeight
              });

              $('.header__bottom').animate({width: 'toggle'});

              $('html, body').css({
                  'overflow': 'hidden',
                  'height': '100%'
              });

            }

            else {

              $('html, body').removeAttr('style');
              $('.header__bottom').animate({width: 'toggle'});

            }
        }
    });

    $( '.search__text' ).focus(function(e) {

        if( window.innerWidth <= 960 ) {

            e.preventDefault();
        }
    });

    $( '.table__row--conversation' ).click(function(e) {
        window.location = $(this).find('a').attr('href');
    });

    $('.form-select').chosen({no_results_text: "Aucun résultat"});

} )();
