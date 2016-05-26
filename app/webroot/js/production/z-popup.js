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

} )();
