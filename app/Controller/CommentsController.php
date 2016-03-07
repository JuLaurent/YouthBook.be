<?php

class CommentsController extends AppController {
    public $helpers = array('Wysiwyg.Wysiwyg' => array('editor' => 'Tinymce'));

    public function add() {

        $this->loadModel('Article');

        $article = $this->Article->find(
            'first',
            array(
                'conditions' => array('Article.id' => $this->request->data['Comment']['article_id']),
            )
        );

        if ($this->request->is('post')) {
            $this->Comment->create();

            if ($this->Comment->save($this->request->data)) {
                return $this->redirect(array('controller' => 'articlePages', 'action' => 'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => $article['Article']['number_of_pages']));
            }
            else {
                $this->Session->setFlash('Le commentaire n’a pas pu être publié. Veuillez réessayer SVP', 'default', array( 'class' => 'message message--bad' ));
            }
        }
    }

    /*public function delete() {

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
    }*/
}
