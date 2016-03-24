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
}
