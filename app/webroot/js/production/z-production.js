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

            $('html, body, .header__bottom').removeAttr('style');

        }
        /*else {

            $('.header__bottom').hide();

        }*/

    });

    $( '.menu--nav' ).click(function() {

        if( window.innerWidth <= 960 ) {

            if( !( $('.header__bottom').is(':visible') ) ) {

                $('.header__bottom').slideDown();
                $('.header__user').hide();

                $('.header').css({
                    'position': 'relative'
                });

                $('.content').css({
                    'padding': '0 0 10em'
                });

            }

            else {

                $('html, body').removeAttr('style');
                $('.header').removeAttr('style');
                $('.content').removeAttr('style');
                $('.header__bottom').slideUp();

            }
        }
    });

    $( '.menu--user' ).click(function() {

        if( window.innerWidth <= 960 ) {

            if( !( $('.header__user').is(':visible') ) ) {

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
