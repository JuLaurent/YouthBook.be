( function() {

    /* $('.ajax__add-comment').submit(function( e ) {

        e.preventDefault();

        var data = {
            Comment : {
                content : tinyMCE.get( 'CommentContent' ).getContent(),
                article_id : $('.ajax__add-comment--article-id').val(),
                user_id : $('.ajax__add-comment--user-id').val()
            }
        };

        var url = $( this ).attr( 'action' );

        if(xhr) xhr.abort();

        var xhr = $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function( responseFromServer, textstatus, jqXHR ) {
                var comment = jQuery.parseJSON( responseFromServer );
               console.log( comment );
            }
        });

    }); */

    $('.social-links').on( 'submit', '.ajax__book-collection', function( e ) {

        e.preventDefault();

        var data = {
            Book : {
                id : $('.ajax__book-collection--id').val()
            },
            User : {
                id : $('.ajax__book-collection--user-id').val()
            }
        };

        var url = $( this ).attr( 'action' );

        if(xhr) xhr.abort();

        var xhr = $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function( responseFromServer, textstatus, jqXHR ) {
                if ( $('.ajax__book-collection').attr( 'action' ) == '/YouthBook.be/books/removeFromCollection' ) {
                    $('.ajax__book-collection').attr( 'action', '/YouthBook.be/books/addToCollection' );
                    $('.ajax__book-collection .user__action--input').val( '+' );
                    $('.ajax__book-collection .user__action--input').attr( 'title', 'Ajouter à ma collection de livres' );
                }
                else {
                    $('.ajax__book-collection').attr( 'action', '/YouthBook.be/books/removeFromCollection' );
                    $('.ajax__book-collection .user__action--input').val( '-' );
                    $('.ajax__book-collection .user__action--input').attr( 'title', 'Enlever de ma collection de livres' );
                }
            }
        });

    });

} )();
