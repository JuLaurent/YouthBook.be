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

    public $validate = array(
        'title' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un titre est requis.'
            ),
        ),
        'User' => array(
            'rule'              => array('multiple', array('min' => '1')),
            'message'           => 'Vous devez sélectionné au moins un interlocuteur.'
        )
    );

    public function beforeSave($options = array()) {

        foreach (array_keys($this->hasAndBelongsToMany) as $model){
    			if(isset($this->data[$this->name][$model])){
    				$this->data[$model][$model] = $this->data[$this->name][$model];
    				unset($this->data[$this->name][$model]);
    			}
    		}

        return true;
    }

}
