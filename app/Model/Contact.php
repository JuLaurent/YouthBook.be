<?php

class Contact extends AppModel {

    public $name = 'Contact';

    public $useTable = false;

    public $validate = array(
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
        'name' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un nom est requis'
            )
        ),
        'text' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un message est requis.'
            )
        )
    );
}
