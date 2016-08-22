<?php

class SagasController extends AppController {

    public $components = array(
        'Auth'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }

    public function index() {

        $sagas = $this->Saga->find(
            'all',
            array(
                'order' => array('Saga.title' => 'asc')
            )
        );

        $this->set(compact('sagas'));
    }

    public function view($slug = null) {

        $this->loadModel('Article');
        $this->loadModel('Book');
        $this->loadModel('Subscription');

        if ( !$slug ) {
            throw new NotFoundException(__('Cette saga n’apparait pas dans la base de données.'));
        }

        $saga = $this->Saga->findBySlug( $slug );

        if ( !$saga ) {
            throw new NotFoundException(__('Cette saga n’apparait pas dans la base de données.'));
        }

        $main = $this->Book->find(
            'all',
            array(
                'joins' => $this->Book->joinSaga,
                'conditions' => array('Book.chronology' => 'main', 'Saga.slug' => $slug),
                'order' => array('Book.title' => 'asc')
            )
        );

        $spinoff = $this->Book->find(
            'all',
            array(
                'joins' => $this->Book->joinSaga,
                'conditions' => array('Book.chronology' => 'spinoff', 'Saga.slug' => $slug),
                'order' => array('Book.title' => 'asc')
            )
        );

        $articles = $this->Article->find(
            'all',
            array(
                'joins' => $this->Article->joinBookSaga,
                'conditions' => array('Saga.id' => $saga['Saga']['id']),
                'order' => array('Article.title' => 'asc')
            )
        );

        $subscription = $this->Subscription->find(
            'first',
            array(
                'conditions' => array('Subscription.user_id' => $this->Session->read('Auth.User.id'), 'Subscription.saga_id' => $saga['Saga']['id'])
            )
        );

        $this->set(compact('saga', 'main', 'spinoff', 'articles', 'subscription'));
    }

    public function add() {

        $books = $this->Saga->Book->find(
            'list',
            array(
                'order' => array('Book.title' => 'asc')
            )
        );

        $this->set(compact('books'));

        if ( $this->request->is('post') ) {
            $this->Saga->create();
            if ($this->Saga->saveAll($this->request->data)) {

                $newSaga = $this->Saga->findById( $this->Saga->id );
                return $this->redirect(array('action' => 'view', 'slug' => $newSaga['Saga']['slug']));
            }
            else {
                $this->Flash->error('La saga n’a pas pu être ajoutée. Veuillez réessayer SVP.');
            }
        }
    }

    public function edit($slug = null) {

        if ( !$slug ) {
            throw new NotFoundException(__('Cette saga n’apparait pas dans la base de données.'));
        }

        $saga = $this->Saga->findBySlug($slug);

        if ( !$saga ) {
            throw new NotFoundException(__('Cette saga n’apparait pas dans la base de données.'));
        }

        $books = $this->Saga->Book->find(
            'list',
            array(
                'order' => array('Book.title' => 'asc')
            )
        );

        $access = true;

        if ($saga['Saga']['user_id'] != $this->Session->read('Auth.User.id') && $this->Session->read('Auth.User.role') != 'administrateur' && $this->Session->read('Auth.User.role') != 'modérateur') {
            $access = false;
        }

        $this->set(compact('saga', 'access', 'books'));

        $this->Saga->id = $saga['Saga']['id'];

        if ( $this->request->is('post') || $this->request->is('put') ) {

            if ($this->Saga->saveAll($this->request->data)) {

                $newSaga = $this->Saga->findById( $saga['Saga']['id'] );

                return $this->redirect(array('action' => 'view', 'slug' => $newSaga['Saga']['slug']));

            }
            else {
                $this->Flash->error('La fiche n’a pas pu être été éditée. Veuillez réessayer SVP.');
            }
        }
        else {
            $this->request->data = $this->Saga->read(null, $saga['Saga']['id']);
        }
    }

}
