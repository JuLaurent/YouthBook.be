<?php

class Notification extends AppModel {

    public $name = 'Notification';

    public $belongsTo = array(
        'Article',
        'User'
    );
}
