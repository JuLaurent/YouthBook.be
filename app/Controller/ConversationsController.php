<?php

class ConversationsController extends AppController {
    public $helpers = array('Wysiwyg.Wysiwyg' => array('editor' => 'Tinymce'));

    public function index() {

        $conversations = $this->Conversation->find(
            'all',
            array(
                'joins' => $this->Conversation->joinUser,
                'conditions' => array('User.id' => $this->Session->read('Auth.User.id')),
            )
        );

        $this->set(compact('conversations'));
    }

    public function add() {
        $this->loadModel('User');

        $users = $this->Conversation->User->find(
            'list',
            array(
                'conditions' => array('User.id !=' => $this->Session->read('Auth.User.id')),
                'order' => array('User.username' => 'asc')
            )
        );

        $this->set(compact('users'));

        if ($this->request->is('post')) {

            $this->Conversation->create();

            if ($this->Conversation->saveAll($this->request->data)) {
                return $this->redirect($this->referer());
            }
            else {
                return $this->redirect($this->referer());
            }
        }
    }
}
