( function() {

    $( 'body' ).swiperight(function() {

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
        }
    });

    $( 'body' ).swipeleft(function(e) {

      if( window.innerWidth <= 960 ) {

            if( $('.header__bottom').is(':visible') ) {

              $('html, body').removeAttr('style');
              $('.header__bottom').animate({width: 'toggle'});


            }
        }
    });

} )();
