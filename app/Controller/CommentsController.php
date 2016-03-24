<?php

class CommentsController extends AppController {
    public $helpers = array('Wysiwyg.Wysiwyg' => array('editor' => 'Tinymce'));

    public function index($slug1 = null) {

        $comments = $this->Comment->find(
            'all',
            array(
                'conditions' => array('Comment.article_id' => $slug1),
                'order' => array('Comment.created' => 'desc')
            )
        );

        $this->set(compact('comments'));
    }

    public function add() {

        /* $this->loadModel('Article');

        $article = $this->Article->find(
            'first',
            array(
                'conditions' => array('Article.id' => $this->request->data['Comment']['article_id']),
            )
        ); */

        if ($this->request->is('post')) {
            $this->Comment->create();

            if ($this->Comment->save($this->request->data)) {
                return $this->redirect($this->referer());
            }
            else {
                $this->Session->setFlash('Le commentaire n’a pas pu être publié. Veuillez réessayer SVP', 'default', array( 'class' => 'message message--bad' ));
            }
        }
    }

    public function delete() {
        $comment = $this->Comment->findById($this->request->data['Comment']['id']);

        if (!$comment) {
            throw new NotFoundException(__('Ce commentaire n’existe pas.'));
        }

        $this->Comment->id = $comment['Comment']['id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Comment->save($this->request->data)) {

                return $this->redirect($this->referer());

            }
            else {
                $this->Session->setFlash('Le commentaire n’a pas pu été supprimé. Veuillez réessayer SVP.', 'default', array( 'class' => 'message message--bad' ));
            }
        }
        else {
            $this->request->data = $this->Comment->read(null, $comment['Comment']['id']);
        }
    }

    public function like() {

        $comment = $this->Comment->findById($this->request->data['Comment']['id']);

        if (!$comment) {
            throw new NotFoundException(__('Ce commentaire n’existe pas.'));
        }

        $this->Comment->id = $comment['Comment']['id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Comment->saveAll($this->request->data)) {

                return $this->redirect($this->referer());

            }
            else {
                $this->Session->setFlash('Le like n’a pas pu être ajouté. Veuillez réessayer SVP.', 'default', array( 'class' => 'message message--bad' ));
            }
        }
        else {
            $this->request->data = $this->Comment->read(null, $comment['Comment']['id']);
        }
    }

    public function dislike() {

        $this->loadModel('Like');

        $comment = $this->Comment->findById($this->request->data['Comment']['id']);

        if (!$comment) {
            throw new NotFoundException(__('Ce commentaire n’existe pas.'));
        }

        $this->Comment->id = $comment['Comment']['id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Comment->saveAll($this->request->data)) {

                $this->Like->query('DELETE from yb_likes WHERE comment_id = "' . $this->request->data['Like']['0']['comment_id'] . '"AND user_id = "' . $this->request->data['Like']['0']['user_id'] . '"');

                return $this->redirect($this->referer());

            }
            else {
                $this->Session->setFlash('Le like n’a pas pu être ajouté. Veuillez réessayer SVP.', 'default', array( 'class' => 'message message--bad' ));
            }
        }
        else {
            $this->request->data = $this->Comment->read(null, $comment['Comment']['id']);
        }
    }
}
