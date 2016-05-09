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

} )();
