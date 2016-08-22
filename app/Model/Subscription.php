<?php

class Subscription extends AppModel {

    public $name = 'Subscription';

    public $belongsTo = array(
        'Saga',
        'User'
    );
}
