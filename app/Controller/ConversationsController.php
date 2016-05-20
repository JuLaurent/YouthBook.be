<?php

class ConversationsController extends AppController {
    public $helpers = array('Wysiwyg.Wysiwyg' => array('editor' => 'Tinymce'));

    public $components = array(
        'Auth'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny();
    }

    public function index() {

        $this->loadModel('ConversationsUser');

        $conversations = $this->Conversation->find(
            'all',
            array(
                'joins' => $this->Conversation->joinUser,
                'conditions' => array('User.id' => $this->Session->read('Auth.User.id')),
            )
        );

        $conversationsUser = $this->ConversationsUser->find(
            'all',
            array(
                'conditions' => array('ConversationsUser.user_id' => $this->Session->read('Auth.User.id'))
            )
        );

        $this->set(compact('conversations', 'conversationsUser'));
    }

    public function view($slug = null) {

        $this->loadModel('ConversationsUser');
        $this->loadModel('Message');
        $this->loadModel('User');

        $conversation = $this->Conversation->findById($slug);

        $messages = $this->Message->find(
            'all',
            array(
                'conditions' => array('Conversation.id' => $slug)
            )
        );

        /*$users = $this->Conversation->User->find(
            'list',
            array(
                'fields' => array('User.username'),
                'conditions' => array('User.id !=' => $this->Session->read('Auth.User.id')),
                'order' => array('User.username' => 'asc')
            )
        );*/

        $users = $this->User->find(
            'all',
            array(
                'recursive' => -1,
                'joins' => $this->User->joinConversation,
                'conditions' => array('Conversation.id' => $slug)
            )
        );

        $access = false;

        foreach( $users as $user ) {
            if ( $this->Session->read('Auth.User.id') != null && in_array( $this->Session->read('Auth.User.id'), $user['User'] ) ) {
                $access = true;
            }
        }

        if ( $access == false ) {
            throw new NotFoundException(__('Vous ne pouvez pas avoir accès à cette conversation.'));
        }

        $conversationUser = $this->ConversationsUser->find(
            'first',
            array(
                'conditions' => array('ConversationsUser.conversation_id' => $slug, 'ConversationsUser.user_id' => $this->Session->read('Auth.User.id'))
            )
        );

        if ( $conversationUser['ConversationsUser']['seen'] == false ) {
            $this->ConversationsUser->id = $conversationUser['ConversationsUser']['id'];
            $data = array( 'ConversationsUser' => array( 'seen' => true ) );

            $this->ConversationsUser->save($data);
        }

        $this->set(compact('conversation', 'messages', 'access'));
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

            if( !empty( $this->request->data['Conversation']['User'] ) ) {
                array_push($this->request->data['Conversation']['User'], $this->Session->read('Auth.User.id'));
            }

            $this->Conversation->create();

            if ($this->Conversation->saveAll($this->request->data)) {
                return $this->redirect(array('action' => 'view', 'slug' => $this->Conversation->id));
            }
            else {
                $this->Flash->error('La conversation n’a pas pu être créée. Veuillez réessayer SVP.');
            }
        }
    }

    public function addMessage() {

        $this->loadModel('ConversationsUser');

        $conversation = $this->Conversation->findById($this->request->data['Conversation']['id']);

        if (!$conversation) {
            throw new NotFoundException(__('Cette conversation n’apparait pas dans la base de données.'));
        }

        $this->Conversation->id = $conversation['Conversation']['id'];

        if ( $this->request->is('post') || $this->request->is('put') ) {

            if ( $this->Conversation->saveAll($this->request->data) ) {

                $conversationsUser = $this->ConversationsUser->find(
                    'all',
                    array(
                        'conditions' => array( 'ConversationsUser.conversation_id' => $conversation['Conversation']['id'], 'ConversationsUser.user_id !=' => $this->Session->read('Auth.User.id') )
                    )
                );

                $data = array( 'ConversationsUser' => array( 'seen' => false ) );

                foreach( $conversationsUser as $conversationUser ) {
                    $this->ConversationsUser->id = $conversationUser['ConversationsUser']['id'];
                    $this->ConversationsUser->save( $data );
                }

                return $this->redirect($this->referer());
            }
            else {
                $this->Session->write('errors.Conversation', $this->Conversation->validationErrors);
                $this->Session->write('data', $this->request->data);
                $this->Session->write('flash', 'Le message n’a pas pu être publié. Veuillez réessayer SVP.');

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
