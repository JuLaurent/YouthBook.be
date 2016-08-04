( function() {

    $('.image-box__popup').magnificPopup({
        type: 'image',
        zoom: {
          enabled: true, // By default it's false, so don't forget to enable it
          duration: 300, // duration of the effect, in milliseconds
          easing: 'ease-in-out', // CSS transition easing function
        },
        tClose: 'Fermer',
        tLoading: 'Chargement...',
        image: {
          titleSrc: '',
          tError: '<a href="%url%">L’image</a> ne peut être chargée.'

        },
        ajax: {
          tError: '<a href="%url%">La requête</a> a échouée.'
        }
    });

    if( window.innerWidth > 960 ) {
        $('.action__popup').on( 'click', function(e) {
            console.log( $(this).attr('data-number') );

            if ( parseFloat( $(this).attr('data-number') ) > 0 ) {
                e.preventDefault();

                if ( $('.bubble-popup').is(':visible') ) {
                    $('.bubble-popup').hide();
                }
                else {
                    $('.bubble-popup').show();
                }
            }
        });
    }

} )();
