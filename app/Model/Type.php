<?php

class Type extends AppModel {

    public $name = 'Type';

    public $hasAndBelongsToMany = array(
        'Article'
    );
}
