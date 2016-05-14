( function() {

    tinymce.init({
        selector: '.wysiwyg',
        language: 'fr_FR',
        plugins: [
            'lists link image',
            'imagetools'
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
            'lists link image',
            'imagetools'
        ],
        toolbar: 'insertfile undo rsedo | styleselect | bold italic | bullist numlist outdent indent | link image',
        style_formats: [

                {title: 'Inline', items: [
                    {title: 'Bold', inline: 'b', icon: 'bold'},
                    {title: 'Italic', inline: 'i', icon: 'italic'},
                    {title: 'Underline', inline: 'span', styles : {textDecoration : 'underline'}, icon: 'underline'},
                    {title: 'Strikethrough', inline: 'span', styles : {textDecoration : 'line-through'}, icon: 'strikethrough'},
                    {title: 'Superscript', inline: 'sup', icon: 'superscript'},
                    {title: 'Subscript', inline: 'sub', icon: 'subscript'},
                ]},
                {title: 'Blocks', items: [
                    {title: 'Paragraph', block: 'p'},
                    {title: 'Blockquote', block: 'blockquote'},
                    {title: 'Div', block: 'div'},
                ]}
            ],
        imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

} )();
