<?php

class Conversation extends AppModel {

    public $name = 'Conversation';

    public $hasMany = array(
        'Message'
    );

    public $hasAndBelongsToMany = array(
        'User'
    );
}
