<?php

class RequestsController extends AppController {

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

    public function delete() {

        $this->loadModel('Book');

        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        $request = $this->Request->findByBookId($this->request->data['Request']['book_id']);

        $book = $this->Book->findById($this->request->data['Request']['book_id']);

        if($this->request->is('post')) {
            if( count($request['User']) > 1 ) {
                if ($this->Request->query('DELETE from yb_requests_users WHERE request_id = "' . $request['Request']['id'] . '"AND user_id = "' . $this->request->data['User']['id'] . '"')) {
                    return $this->redirect(array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']));
                }
                else {
                    return $this->redirect(array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']));
                }
            }
            else {
                if ($this->Request->delete($request['Request']['id'], false)) {
                    return $this->redirect(array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']));
                }
                else {
                    return $this->redirect(array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']));
                }
            }
        }

    }

}
