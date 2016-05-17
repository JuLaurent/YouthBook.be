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

    $( '.popup-box__filter' ).on('click', function() {
        $( '.popup-box' ).hide('slow');
    });

    $('.social-links').on( 'submit', '.ajax__book-collection', function( e ) {

        e.preventDefault();

        var self = $( this );

        var data = {
                Book : {
                    id : self.find('.ajax__book-collection--id').val()
                },
                User : {
                    id : self.find('.ajax__book-collection--user-id').val()
                }
            },
            url = self.attr( 'action' );

        if(xhr) xhr.abort();

        var xhr = $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function( responseFromServer, textstatus, jqXHR ) {
                if ( self.attr( 'action' ) == '/YouthBook.be/books/removeFromCollection' ) {
                    self.attr( 'action', '/YouthBook.be/books/addToCollection' );
                    self.find('.user__action--input').val( '+' )
                                                     .attr( 'title', 'Ajouter à ma collection de livres' );
                }
                else {
                    self.attr( 'action', '/YouthBook.be/books/removeFromCollection' );
                    self.find('.user__action--input').val( '-' )
                                                     .attr( 'title', 'Enlever de ma collection de livres' );
                }
            }
        });
    });

    $('.collection__item').on( 'submit', '.ajax__user-remove', function( e ) {

        e.preventDefault();

        var self = $( this );

        $( '.popup-box--confirm' )
            .find( '.popup-box__sentence' )
                .html( 'Voulez-vous supprimer ce livre de votre collection ?' )
                .end()
            .show('slow');

        $( '.popup-box--confirm' ).on( 'click', '.popup-box__option', function( e ) {

            $( '.popup-box--confirm' ).hide('slow');

            if ( $( this ).attr( 'data-option' ) == 'true' ) {

                var data = {
                    Book : {
                        id : self.find('.ajax__user-remove--id').val()
                    },
                    User : {
                        id : self.find('.ajax__user-remove--user-id').val()
                    }
                };

                var url = self.attr( 'action' );

                if(xhr) xhr.abort();

                var xhr = $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function( responseFromServer, textstatus, jqXHR ) {
                        self.parents('.collection__item').hide('slow');
                    }
                });
            }
        });
    });

    $('.comment').on( 'submit', '.ajax__like', function( e ) {

        e.preventDefault();

        var self = $( this );
        var data = {
            Comment : {
                id : self.find('.ajax__like--id').val(),
                number_of_likes : self.find('.ajax__like--number-of-likes').val()
            },
            Like : {
                0 : {
                    comment_id : self.find('.ajax__like--like-comment-id').val(),
                    user_id : self.find('.ajax__like--like-user-id').val(),
                }
            }
        };

        var url = $( this ).attr( 'action' );

        if(xhr) xhr.abort();

        var xhr = $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function( responseFromServer, textstatus, jqXHR ) {
                if ( self.attr( 'action' ) == '/YouthBook.be/comments/like' ) {
                    self.attr( 'action', '/YouthBook.be/comments/dislike' );
                    self
                        .find('.comment__icon')
                            .removeClass( 'comment__like' )
                            .addClass( 'comment__dislike' )
                            .val( 'Ne plus aimer ce commentaire' )
                            .attr( 'title', 'Ne plus aimer ce commentaire' )
                            .end()
                        .parents('.comment')
                            .find('.comment__number')
                                .html( +self.parents('.comment').find('.comment__number').html() + 1 );
                }
                else {
                    self.attr( 'action', '/YouthBook.be/comments/like' );
                    self
                        .find('.comment__icon')
                            .removeClass( 'comment__dislike' )
                            .addClass( 'comment__like' )
                            .val( 'Aimer ce commentaire' )
                            .attr( 'title', 'Aimer ce commentaire' )
                            .end()
                        .parents('.comment')
                            .find('.comment__number')
                                .html( +self.parents('.comment').find('.comment__number').html() - 1 );
                }
            }
        });
    });

    $('.comment').on( 'submit', '.ajax__comment-delete', function( e ) {

        e.preventDefault();

        var self = $( this );

        $( '.popup-box--confirm' )
            .find( '.popup-box__sentence' )
                .html( 'Voulez-vous supprimer ce commentaire ?' )
                .end()
            .show('slow');

        $( '.popup-box--confirm' ).on( 'click', '.popup-box__option', function( e ) {

            $( '.popup-box--confirm' ).hide('slow');

            if ( $( this ).attr( 'data-option' ) == 'true' ) {
                var data = {
                    Comment : {
                        id : self.find('.ajax__comment-delete--id').val(),
                        content : self.find('.ajax__comment-delete--content').val(),
                        deleted : self.find('.ajax__comment-delete--deleted').val() === "1"
                    }
                };

                var url = self.attr( 'action' );

                if(xhr) xhr.abort();

                var xhr = $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function( responseFromServer, textstatus, jqXHR ) {
                        self
                            .parents('.comment')
                                .find('.comment__actions')
                                    .hide( "slow" )
                                    .end()
                                .find('.comment__content')
                                    .html( '<p class=\'message message--bad\'>Ce commentaire a été supprimé</p>' );
                    }
                });
            }
        });
    });

    $( '.side__action' ).on( 'submit', '.ajax__article-delete', function( e ) {
        e.preventDefault();

        var self = $( this );

        $( '.popup-box--confirm' )
            .find( '.popup-box__sentence' )
                .html( 'Voulez-vous supprimer cet article ?' )
                .end()
            .show('slow');

        $( '.popup-box--confirm' ).on( 'click', '.popup-box__option', function( e ) {

            $( '.popup-box--confirm' ).hide('slow');

            if ( $( this ).attr( 'data-option' ) == 'true' ) {
                var data = {
                    Article : {
                        id : self.find('.ajax__article-delete--id').val(),
                    }
                };

                var url = self.attr( 'action' );

                if(xhr) xhr.abort();

                var xhr = $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function() {
                        window.location.href = '/YouthBook.be/'
                    }
                });
            }
        });
    });

} )();
