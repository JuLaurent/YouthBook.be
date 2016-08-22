( function () {

    $( '.popup-box__filter' ).on('click', function() {
        $( '.popup-box' ).hide('slow');
    });

    $( '.user__connect' ).on('click', function( e ) {
        e.preventDefault();

        $( '.popup-box--connect' ).show('slow');
    });

    $( '.popup-box__close-button' ).on('click', function( e ) {
        $( '.popup-box' ).hide('slow');
    });


    $( document ).on('paste', '.no-past', function( e ) {
        e.preventDefault();
    });


    $( window ).resize( function(e) {

        if( window.innerWidth > 960 ) {

            $('html, body, .header__bottom, .header__user').removeAttr('style');

        }
        else {
            $('.bubble-popup').removeAttr('style');
        }

    });

    $( '.menu--nav' ).click(function() {

        if( window.innerWidth <= 960 ) {

            if( !( $('.header__bottom').is(':visible') ) ) {

                $('.menu--nav').css('background-color', '#1E5F7D');
                $('.menu--user').removeAttr('style');

                $('.header__bottom').slideDown();
                $('.header__user').hide();

                $('.header').css({
                    'position': 'relative'
                });

            }

            else {

                $('.menu--nav').removeAttr('style');
                $('html, body').removeAttr('style');
                $('.header').removeAttr('style');
                $('.header__bottom').slideUp();

            }
        }
    });

    $( '.menu--user' ).click(function() {

        if( window.innerWidth <= 960 ) {

            if( !( $('.header__user').is(':visible') ) ) {

                $('.menu--user').css('background-color', '#1E5F7D');
                $('.menu--nav').removeAttr('style');

                $('.header__user').slideDown();
                $('.header__bottom').hide();

                $('.header').css({
                    'position': 'relative'
                });

                $('.content').css({
                    'padding': '0 0 10em'
                });

            }

            else {

                $('.menu--user').removeAttr('style');
                $('.header').removeAttr('style');
                $('.content').removeAttr('style');
                $('.header__user').slideUp();

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
