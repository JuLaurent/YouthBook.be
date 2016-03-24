<?php

class Like extends AppModel {

    public $name = 'Like';

    public $belongsTo = array(
        'Comment',
        'User'
    );
}
