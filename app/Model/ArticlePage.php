<?php

class ArticlePage extends AppModel {

    public $name = 'ArticlePage';

    public $belongsTo = array(
        'Article'
    );

    public $validate = array(
        'content' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un contenu est requis.'
            )
        )
    );
}
