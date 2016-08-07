( function() {

    $( '.form__rating' ).insertBefore( '#ArticleRating' );
    $( '#ArticleRating' ).hide();
    $( '.form__rating' ).show();

    $( '.form__rating-button[data-rating="' + $( '#ArticleRating' ).attr('value') + '"]' ).addClass('form__rating-button--active');

    $( '.form__rating-button' ).click( function(e) {
        e.preventDefault();

        $( '.form__rating-button' ).removeClass('form__rating-button--active');
        $(this).addClass('form__rating-button--active');
        $( '#ArticleRating' ).attr( 'value', $(this).attr('data-rating') );
    } )

} )();
