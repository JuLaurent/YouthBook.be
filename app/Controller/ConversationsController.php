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

    public function view($slug = null) {

        $this->loadModel('Message');

        $conversation = $this->Conversation->findById($slug);

        $messages = $this->Message->find(
            'all',
            array(
                'conditions' => array('Conversation.id' => $slug)
            )
        );

        $users = $this->Conversation->User->find(
            'list',
            array(
                'fields' => array('User.username'),
                'conditions' => array('User.id !=' => $this->Session->read('Auth.User.id')),
                'order' => array('User.username' => 'asc')
            )
        );

        $this->set(compact('conversation', 'messages', 'users'));
    }

    public function add() {
        $this->loadModel('User');

        $users = $this->Conversation->User->find(
            'list',
            array(
                'fields' => array('User.username'),
                'conditions' => array('User.id !=' => $this->Session->read('Auth.User.id')),
                'order' => array('User.username' => 'asc')
            )
        );

        $this->set(compact('users'));

        if ($this->request->is('post')) {

            array_push($this->request->data['User']['User'], $this->Session->read('Auth.User.id'));

            $this->Conversation->create();

            if ($this->Conversation->saveAll($this->request->data)) {
                return $this->redirect($this->referer());
            }
            else {
                return $this->redirect($this->referer());
            }
        }
    }

    public function addSpeakers() {
        $this->loadModel('User');

        $this->set(compact('users'));

        if ($this->request->is('post')) {

            array_push($this->request->data['User']['User'], $this->Session->read('Auth.User.id'));

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
