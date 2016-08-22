<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $name = 'User';

    public $hasMany = array(
        'Article',
        'Comment',
        'Like',
        'Notification',
        'Message',
        'Subscription',
        'Saga'
    );

    public $hasAndBelongsToMany = array(
        'Book',
        'Conversation',
        'Request' => array(
            'unique' => false
        )
    );

    public $joinConversation = array(
        array(
            'table' => 'yb_conversations_users',
            'alias' => 'ConversationUser',
            'type' => 'inner',
            'conditions' => array(
                'User.id = ConversationUser.user_id'
            )
        ),
        array(
            'table' => 'yb_conversations',
            'alias' => 'Conversation',
            'type' => 'inner',
            'conditions' => array(
                'ConversationUser.conversation_id = Conversation.id'
            )
        )
    );

    public $actsAs = array(
        'Upload.Upload' => array(
            'avatar' => array(
                'path' => '{ROOT}webroot{DS}img{DS}avatars{DS}',
                'thumbnailMethod' => 'php',
                'thumbnailSizes' => array(
                    'thumbHR' => '142x142',
                    'thumb' => '71x71',
                    'smallHR' => '96x96',
                    'small' => '48x48'
                ),
                'deleteOnUpdate' => 'true'
            )
        )
    );

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un pseudo est requis'
            ),
            'length' => array(
                'rule'          => array('between', 4, 16),
                'message'       => 'Votre pseudo doit contenir entre 4 et 16 caractères.',
                'on'            => 'create'
            ),
            'unique' => array(
                'rule'          => 'isUnique',
                'message'       => 'Ce pseudo a déjà été choisi.',
                'on'            => 'create'
            )
        ),
        'verif_username' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un pseudo est requis'
            )
        ),
        'password' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un mot de passe est requis.'
            ),
            'length' => array(
                'rule'          => array('between', 6, 16),
                'message'       => 'Votre mot de passe doit contenir entre 6 et 16 caractères.'
            )
        ),
        'confirm_password' => array(
            'same' => array(
                'rule'          => array('compareFields', 'password', 'confirm_password'),
                'message'       => 'Le mot de passe n’est pas identique.',
            )
        ),
        'mail' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Une adresse mail est requise.',
                'on'            => 'create'
            ),
            'mail' => array(
                'rule'          => array('email'),
                'message'       => 'Votre adresse mail doit avoir un format valide.',
                'allowEmpty'    => true
            )
        ),
        'confirm_mail' => array(
            'same' => array(
                'rule'          => array('compareFields', 'mail', 'confirm_mail'),
                'message'       => 'L’adresse mail n’est pas identique.'
            )
        ),
        'verif_mail' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Une adresse mail est requise.'
            ),
            'mail' => array(
                'rule'          => array('email'),
                'message'       => 'Votre adresse mail doit avoir un format valide.',
                'allowEmpty'    => true
            )
        ),
        'role' => array(
            'valid' => array(
                'rule'          => array('inList', array('admin', 'modérateur', 'membre')),
                'message'       => 'Merci de rentrer un rôle valide',
                'allowEmpty'    => false
            )
        ),
        'avatar' => array(
            'valid' => array(
                'rule'          => array('isValidExtension', array('gif', 'jpeg', 'png', 'jpg'), false),
                'message'       => 'Votre image doit avoir un format valide.'
            ),
            'sameName' => array(
                'rule'          => array('sameName'),
                'message'       => 'Une image avec ce nom existe déjà.',
                'on'            => 'update'
            )
        )
    );

    public function beforeSave($options = array()) {

        if (isset($this->data[$this->alias]['username'])) {
            $this->data[$this->alias]['slug'] = Inflector::slug($this->data[$this->alias]['username'], '-');
        }

        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }

        return true;
    }
}
