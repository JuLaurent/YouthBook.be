<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $name = 'User';

    public $hasMany = array(
        'Article'
    );

    public $hasAndBelongsToMany = array(
        'Book',
        'Request' => array(
            'unique' => false
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
                'message'       => 'Votre pseudo doit contenir entre 4 et 16 caractères.'
            ),
            'unique' => array(
                'rule'          => 'isUnique',
                'message'       => 'Ce pseudo a déjà été choisi.'
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
