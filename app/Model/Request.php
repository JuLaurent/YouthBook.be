<?php

class Request extends AppModel {

    public $name = 'Request';

    public $belongsTo = array(
        'Book'
    );

    public $hasAndBelongsToMany = array(
        'User' => array(
            'unique' => false
        )
    );
}
