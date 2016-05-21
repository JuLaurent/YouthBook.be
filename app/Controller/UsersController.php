<?php

// app/Controller/UsersController.php
class UsersController extends AppController {

    public $components = array(
        'Auth' => array(
            'loginRedirect' => '/',
            'logoutRedirect' => '/'
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'login', 'edit', 'view');
    }

    public function login() {

        if ( $this->request->is('post')) {
            if ( $this->Auth->login() ) {
                if( $this->referer() == Router::fullbaseUrl() . Router::url(array('controller' => 'users', 'action' => 'login')) ) {
                    return $this->redirect($this->Auth->redirectUrl());
                }
                else {
                    return $this->redirect($this->referer());
                }
            } else {
                $this->Flash->error('Pseudo ou mot de passe invalide. Veuillez réessayer SVP');
            }
        }
    }

    public function logout() {

      $this->Session->destroy();

      return $this->redirect($this->Auth->logout());

    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function collection($id = null) {

        $this->loadModel('Book');

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }

        $user = $this->User->read(null, $id);

        $collection = $this->Book->find(
            'all',
            array(
                'joins' => $this->Book->joinUser,
                'conditions' => array('User.id' => $this->User->id),
                'order' => array('Book.title' => 'asc')
            )
        );

        $this->set(compact('user', 'collection'));
    }

    public function books($id = null) {

        $this->loadModel('Book');

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }

        $user = $this->User->read(null, $id);

        $books = $this->Book->find(
            'all',
            array(
                'conditions' => array('Book.creator_id' => $this->User->id),
                'order' => array('Book.title' => 'asc')
            )
        );

        $this->set(compact('user', 'books'));
    }

    public function sagas($id = null) {

        $this->loadModel('Saga');

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }

        $user = $this->User->read(null, $id);

        $sagas = $this->Saga->find(
            'all',
            array(
                'conditions' => array('user_id' => $this->User->id),
                'order' => array('Saga.title' => 'asc')
            )
        );

        $this->set(compact('user', 'sagas'));
    }

    public function articles($id = null) {

        $this->loadModel('Article');

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }

        $user = $this->User->read(null, $id);

        $articles = $this->Article->find(
            'all',
            array(
                'conditions' => array('draft' => 0, 'User.id' => $this->User->id),
                'order' => array('Article.title' => 'asc')
            )
        );

        $this->set(compact('user', 'articles'));
    }

    public function drafts($id = null) {

        $this->loadModel('Article');

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }

        $user = $this->User->read(null, $id);

        $drafts = $this->Article->find(
            'all',
            array(
                'conditions' => array('draft' => 1, 'User.id' => $this->User->id),
                'order' => array('Article.title' => 'asc')
            )
        );

        $this->set(compact('user', 'drafts'));
    }

    public function add() {

        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                if ($this->Auth->login()) {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->error('Votre compte n’a pas pu être créé. Veuillez réessayer SVP.');
            }
        }
    }

    public function editInformations($id = null) {

        $this->User->id = $this->Auth->user('id');

        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->User->save($this->request->data)) {

                $this->Session->write('Auth', $this->User->read(null, $this->Auth->user('id')));
                $this->Flash->success('Vos données ont été éditées');
                // return $this->redirect(array('action' => 'editInformations'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error('Vos données n’ont pu être été éditées. Veuillez réessayer SVP.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function editPassword($id = null) {

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->write('Auth', $this->User->read(null, $this->Auth->user('id')));
                $this->Flash->success('Votre mot de passe a été édité');
                // return $this->redirect(array('action' => 'editPassword'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error('Votre mot de passe n’a pas pu être été édité. Veuillez réessayer SVP.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Avant 2.5, utilisez
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Utilisateur invalide', 'default', array( 'class' => 'message message--bad' ));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash('Votre compte a été supprimé.', 'default', array( 'class' => 'message message--good'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Votre compte n’a pu être supprimé.', 'default', array( 'class' => 'message message--bad' ));
        return $this->redirect(array('action' => 'index'));
    }

    public function addToCollection() {

        $this->loadModel('Book');

        $book = $this->Book->findById($this->request->data['Book']['id']);
        $this->Book->id = $book['Book']['id'];

        if ($this->request->is('post')) {
            if ($this->Book->save($this->request->data)) {
                return $this->redirect(array('action' => 'books'));
            }
        }
    }

    /* public function removeFromCollection() {

        $this->loadModel('Book');

        $book = $this->Book->findById($this->request->data['Book']['id']);

        if ($this->request->is('post')) {
            $this->Book->query('DELETE from yb_books_users WHERE book_id = "' . $this->request->data['Book']['id'] . '"AND user_id = "' . $this->request->data['User']['id'] . '"');
            return $this->redirect($this->referer());
        }
    } */

}
