<?php

class Message extends AppModel {

    public $name = 'Message';

    public $belongsTo = array(
        'Conversation',
        'User'
    );

    public $validate = array(
        'content' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un message est requis.'
            )
        )
    );
}
