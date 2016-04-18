<?php

class SagasController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {

        //$this->loadModel('Article');
        //$this->loadModel('Type');

        $notDoneRequests = $this->Request->find(
            'all',
            array(
                'conditions' => array('Request.done' => 0),
                'order' => array('Request.modified' => 'desc')
            )
        );

        $doneRequests = $this->Request->find(
            'all',
            array(
                'recursive' => 2,
                'conditions' => array('Request.done' => 1),
                'order' => array('Request.modified' => 'desc')
            )
        );

        //$types = $this->Article->Type->find('list');

        $this->set(compact('notDoneRequests', 'doneRequests'));

    }

    public function add() {

        $this->loadModel('Book');

        $request = $this->Request->find(
            'first',
            array(
                'conditions' => array('Request.book_id' => $this->request->data['Request']['book_id']),
            )
        );

        $book = $this->Book->findById($this->request->data['Request']['book_id']);

        if( $request == '' ) {
            if ($this->request->is('post')) {
                if ($this->Request->save($this->request->data)) {
                    return $this->redirect(array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']));
                }
            }
        }
        else {
            $this->Request->id = $request['Request']['id'];

            if ($this->request->is('post')) {
                if ($this->Request->save($this->request->data)) {
                    return $this->redirect(array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']));
                }
            }
        }
    }

}
