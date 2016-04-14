<?php

class Conversation extends AppModel {

    public $name = 'Conversation';

    public $hasMany = array(
        'Message'
    );

    public $hasAndBelongsToMany = array(
        'User'
    );

    public $joinUser = array(
        array(
            'table' => 'yb_conversations_users',
            'alias' => 'ConversationUser',
            'type' => 'inner',
            'conditions' => array(
                'Conversation.id = ConversationUser.conversation_id'
            )
        ),
        array(
            'table' => 'yb_users',
            'alias' => 'User',
            'type' => 'inner',
            'conditions' => array(
                'ConversationUser.user_id = User.id'
            )
        )
    );
}
