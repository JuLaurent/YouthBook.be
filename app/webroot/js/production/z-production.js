(function () {

    $(document).foundation();

    $( window ).resize( function(e) {

        if( window.innerWidth > 960 ) {

            $('html, body, .header__bottom').removeAttr('style');

        }
        /*else {

            $('.header__bottom').hide();

        }*/

    });

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

    $( '.menu__link' ).click(function() {

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

            else {

              $('html, body').removeAttr('style');
              $('.header__bottom').animate({width: 'toggle'});

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

    $('.form-select').chosen({no_results_text: "Aucun résultat"});

    tinymce.init({
        selector: '.wysiwyg',
        language: 'fr_FR',
        plugins: [
            'advlist autolink lists link image charmap preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media contextmenu paste imagetools'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        style_formats: [
                {title: 'Headers', items: [
                    {title: 'Heading 1', block: 'h3'},
                    {title: 'Heading 2', block: 'h4'},
                ]},

                {title: 'Inline', items: [
                    {title: 'Bold', inline: 'b', icon: 'bold'},
                    {title: 'Italic', inline: 'i', icon: 'italic'},
                    {title: 'Underline', inline: 'span', styles : {textDecoration : 'underline'}, icon: 'underline'},
                    {title: 'Strikethrough', inline: 'span', styles : {textDecoration : 'line-through'}, icon: 'strikethrough'},
                    {title: 'Superscript', inline: 'sup', icon: 'superscript'},
                    {title: 'Subscript', inline: 'sub', icon: 'subscript'},
                    {title: 'Code', inline: 'code', icon: 'code'},
                ]},
                {title: 'Blocks', items: [
                    {title: 'Paragraph', block: 'p'},
                    {title: 'Blockquote', block: 'blockquote'},
                    {title: 'Div', block: 'div'},
                    {title: 'Pre', block: 'pre'}
                ]},
                {title: 'Alignment', items: [
                    {title: 'Left', block: 'div', styles : {textAlign : 'left'}, icon: 'alignleft'},
                    {title: 'Center', block: 'div', styles : {textAlign : 'center'}, icon: 'aligncenter'},
                    {title: 'Right', block: 'div', styles : {textAlign : 'right'}, icon: 'alignright'},
                    {title: 'Justify', block: 'div', styles : {textAlign : 'justify'}, icon: 'alignjustify'}
                ]}
            ],
        imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

    tinymce.init({
        selector: '.wysi2',
        language: 'fr_FR',
        plugins: [
            'advlist autolink lists link image charmap preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media contextmenu paste imagetools'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | bullist numlist outdent indent | link image',
        style_formats: [

                {title: 'Inline', items: [
                    {title: 'Bold', inline: 'b', icon: 'bold'},
                    {title: 'Italic', inline: 'i', icon: 'italic'},
                    {title: 'Underline', inline: 'span', styles : {textDecoration : 'underline'}, icon: 'underline'},
                    {title: 'Strikethrough', inline: 'span', styles : {textDecoration : 'line-through'}, icon: 'strikethrough'},
                    {title: 'Superscript', inline: 'sup', icon: 'superscript'},
                    {title: 'Subscript', inline: 'sub', icon: 'subscript'},
                    {title: 'Code', inline: 'code', icon: 'code'},
                ]},
                {title: 'Blocks', items: [
                    {title: 'Paragraph', block: 'p'},
                    {title: 'Blockquote', block: 'blockquote'},
                    {title: 'Div', block: 'div'},
                    {title: 'Pre', block: 'pre'}
                ]}
            ],
        imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

})();
