<?php

class SagasController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
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

        $this->loadModel('Book');

        $saga = $this->Saga->findBySlug($slug);

        $main = $this->Book->find(
            'all',
            array(
                'conditions' => array('Book.chronology' => 'main', 'Saga.slug' => $slug),
                'order' => array('Book.title' => 'asc')
            )
        );

        $spinoff = $this->Book->find(
            'all',
            array(
                'conditions' => array('Book.chronology' => 'spinoff', 'Saga.slug' => $slug),
                'order' => array('Book.title' => 'asc')
            )
        );

        $this->set(compact('saga', 'main', 'spinoff'));
    }

    public function add() {

        $this->loadModel('Book');

        $books = $this->Saga->Book->find(
            'list',
            array(
                'conditions' => array('Book.saga_id' => null),
                'order' => array('Book.title' => 'asc')
            )
        );

        $this->set(compact('books'));

        if ($this->request->is('post')) {
            $this->Saga->create();
            if ($this->Saga->saveAll($this->request->data)) {

                $newSaga = $this->Saga->findByTitle($this->request->data['Saga']['title']);

                return $this->redirect(array('action' => 'view', 'slug' => $newBook['Saga']['slug']));
            }
            else {
                $this->Flash->error('La saga n’a pas pu être ajoutée. Veuillez réessayer SVP.');
            }
        }
    }

}
