( function() {


    /* $.ajax({
        url: '/YouthBook.be/dynamicPages/countNotSeenConversations',
        success: function( responseFromServer, textstatus, jqXHR ) {
            var number = JSON.parse( responseFromServer );
            if ( number > 0 ) {
                $( '.user__not-seen-conversations' ).show().html( number );
            }
        }
    }); */


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

    $('.sheet__collection').on( 'submit', '.ajax__book-collection', function( e ) {

        e.preventDefault();

        var self = $( this );

        console.log(self);


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
                    self.find('.button--submit').val( 'Ajouter à ma collection' )
                                                     .attr( 'title', 'Ajouter à ma collection de livres' );
                }
                else {
                    self.attr( 'action', '/YouthBook.be/books/removeFromCollection' );
                    self.find('.button--submit').val( 'Enlever de ma collection' )
                                                     .attr( 'title', 'Enlever de ma collection de livres' );
                }
            }
        });
    });

    $('.sheet__collection').on( 'submit', '.ajax__subscription', function( e ) {

        e.preventDefault();

        var self = $( this );

        console.log(self);

        var data = {
                Subscription : {
                    user_id : self.find('.ajax__subscription--user-id').val(),
                    saga_id : self.find('.ajax__subscription--saga-id').val(),
                }
            },
            url = self.attr( 'action' );

        if(xhr) xhr.abort();

        var xhr = $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function( responseFromServer, textstatus, jqXHR ) {
                if ( self.attr( 'action' ) == '/YouthBook.be/subscriptions/unsubscribe' ) {
                    self.attr( 'action', '/YouthBook.be/subscriptions/subscribe' );
                    self.find('.button--submit').val( 'S’abonner' );
                }
                else {
                    self.attr( 'action', '/YouthBook.be/subscriptions/unsubscribe' );
                    self.find('.button--submit').val( 'Se désabonner' );
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

    $('.collection__item').on( 'submit', '.ajax__user-unsubscribe', function( e ) {

        e.preventDefault();

        var self = $( this );

        $( '.popup-box--confirm' )
            .find( '.popup-box__sentence' )
                .html( 'Voulez-vous vous désabonner ?' )
                .end()
            .show('slow');

        $( '.popup-box--confirm' ).on( 'click', '.popup-box__option', function( e ) {

            $( '.popup-box--confirm' ).hide('slow');

            if ( $( this ).attr( 'data-option' ) == 'true' ) {

                var data = {
                    Subscription : {
                        user_id : self.find('.ajax__user-unsubscribe--user-id').val(),
                        saga_id : self.find('.ajax__user-unsubscribe--saga-id').val(),
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
                        window.location = '/YouthBook.be/'
                    }
                });
            }
        });
    });

    var typingTimer;
    var doneTypingInterval = 300;

    $( '.search__form' ).on( 'keyup', '.ajax__datalist--search', function( e ) {

        e.preventDefault();

        if ( e.keyCode != 38 && e.keyCode != 40 ) {
            console.log(e.keyCode);
            clearTimeout( typingTimer );

            if ( $('.ajax__datalist--search').val() ) {
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        }
    });

    var doneTyping = function() {
        var data = {
                Book : {
                    title : $( '.ajax__datalist--search' ).val(),
                }
            },
            url = '/YouthBook.be/dynamicPages/findBooks';

        if(xhr) xhr.abort();

        var xhr = $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function( responseFromServer, textstatus, jqXHR ) {

                var books = JSON.parse( responseFromServer );

                $( '.ajax__datalist--search' ).parents( '.search__form' ).find( '.ajax__datalist--list' ).html( '' );

                for( var i = 0 ; i < books.length ; i++ ) {
                    $( '.ajax__datalist--search' ).parents( '.search__form' ).find( '.ajax__datalist--list' ).append( '<option>' + books[i]['Book']['title'] + '</option>' );
                }
            }
        });
    }

} )();
