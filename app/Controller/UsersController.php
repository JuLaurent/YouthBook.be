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
        $this->Auth->allow('add', 'login', 'edit', 'view', 'forgottenPassword', 'newPassword');
    }

    public function login() {

        if ( $this->request->is('post')) {
            if ( $this->Auth->login() ) {
                if( $this->referer() == Router::fullbaseUrl() . Router::url(array('controller' => 'users', 'action' => 'login')) ||
                    $this->referer() == Router::fullbaseUrl() . Router::url(array('controller' => 'users', 'action' => 'newPassword')) ) {
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
            throw new NotFoundException(__('Utilisateur invalide.'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function collection($id = null) {

        $this->loadModel('Book');
        $this->loadModel('Saga');

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide.'));
        }

        $user = $this->User->read(null, $id);

        $books = $this->Book->find(
            'all',
            array(
                'joins' => $this->Book->joinUser,
                'conditions' => array('User.id' => $this->User->id),
                'order' => array('Book.title' => 'asc')
            )
        );

        $this->set(compact('user', 'books'));
    }

    public function subscriptions($id = null) {

        $this->loadModel('Subscription');

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide.'));
        }

        $user = $this->User->read(null, $id);

        $subscriptions = $this->Subscription->find(
            'all',
            array(
                'conditions' => array('Subscription.user_id' => $this->User->id),
                'order' => array('Saga.title' => 'asc')
            )
        );

        $this->set(compact('user', 'subscriptions'));
    }

    public function books($id = null) {

        $this->loadModel('Book');

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide.'));
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
            throw new NotFoundException(__('Utilisateur invalide.'));
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
            throw new NotFoundException(__('Utilisateur invalide.'));
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
            throw new NotFoundException(__('Utilisateur invalide.'));
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
            throw new NotFoundException(__('Utilisateur invalide.'));
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
            throw new NotFoundException(__('Utilisateur invalide.'));
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

    public function forgottenPassword() {

        if ( $this->request->is('post') ) {
            $this->User->set($this->request->data);

            if ($this->User->validates()) {

                $user = $this->User->find(
                    'first',
                    array(
                        'conditions' => array('User.username' => $this->request->data['User']['verif_username'], 'User.mail' => $this->request->data['User']['verif_mail'])
                    )
                );

                if ( !empty($user) ) {

                    $token = array('User' => array('token' => bin2hex(openssl_random_pseudo_bytes(20))));

                    $this->User->id = $user['User']['id'];

                    $this->User->save($token);

                    $newUser = $this->User->findById($user['User']['id']);

                    App::uses('CakeEmail', 'Network/Email');

                    $Email = new CakeEmail('smtp');
                    $Email->viewVars(array('mailData' => $newUser));
                    $Email->template('newPassword', 'default');
                    $Email->emailFormat('html');
                    $Email->from(array('contact@youthbook.be' => 'YouthBook.be'));
                    $Email->to($this->request->data['User']['verif_mail']);
                    $Email->subject('Mot de passe oublié');

                    $Email->attachments(array(
                        'logo.svg' => array(
                            'file' => WWW_ROOT . '/img/icons/logo.png',
                            'mimetype' => 'image/png',
                            'contentId' => 'logo'
                        )
                    ));

                    $Email->send();

                    $this->Flash->success(__('Votre demande a bien été envoyée.'));
                    return $this->redirect($this->referer());
                }
                else {
                    $this->Flash->error('Cet utilisateur n’existe pas. Veuillez réessayer SVP.');
                }

            }
            else {
                $this->Flash->error('La demande n’a pas pu être envoyé. Veuillez réessayer SVP.');
            }
        }
    }

    public function newPassword($slug1 = null, $slug2 = null) {

        if ( !$slug1 ) {
            throw new NotFoundException(__('Page inacessible.'));
        }

        $user = $this->User->findBySlug($slug1);

        $this->User->id = $user['User']['id'];

        if ( !$this->User->exists() ) {
            throw new NotFoundException(__('Utilisateur invalide.'));
        }

        if ( $user['User']['token'] != $slug2 ) {
            throw new NotFoundException(__('Page inacessible.'));
        }

        $this->set(compact('user'));

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['User']['token'] = null;

            if ($this->User->save($this->request->data)) {
                return $this->redirect(array('action' => 'login'));
            } else {
                $this->Flash->error('Votre mot de passe n’a pas pu être été modifié. Veuillez réessayer SVP.');
            }
        } else {
            // $this->request->data = $this->User->read(null, $id);
            // unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Avant 2.5, utilisez
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide.'));
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
