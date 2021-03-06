<?php

class Comment extends AppModel {

    public $name = 'Comment';

    public $belongsTo = array(
        'Article',
        'User'
    );

    public $hasMany = array(
        'Like'
    );

    public $validate = array(
        'content' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un commentaire est requis.'
            )
        )
    );
}
