<?php

class Saga extends AppModel {

    public $name = 'Saga';

    public $hasMany = array(
        'Book'
    );

    public $belongsTo = array(
        'User'
    );
}
