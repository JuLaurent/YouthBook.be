<?php

class ArticlePagesController extends AppController {
    public $helpers = array('Wysiwyg.Wysiwyg' => array('editor' => 'Tinymce'));

    public $components = array(
        'Auth'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
    }

		public function view($slug1 = null, $slug2 = null, $slug3 = null) {

      $this->loadModel('Comment');
      $this->loadModel('Notification');

      if(!$slug1 && !$slug2) {
          throw new NotFoundException(__('Cet article n’apparait pas dans la base de données.'));
      }

      $articlePage = $this->ArticlePage->find(
          'first',
          array(
              'recursive' => '2',
              'conditions' => array('ArticlePage.page_number' => $slug3, 'Article.id' => $slug1, 'Article.slug' => $slug2)
          )
      );

      if( $articlePage['ArticlePage']['page_number'] == $articlePage['Article']['number_of_pages'] ) {
          $comments = $this->Comment->find(
              'all',
              array(
                  'limit' => 5,
                  'conditions' => array('Comment.article_id' => $slug1, 'Comment.deleted' => '0'),
                  'order' => array('Comment.number_of_likes' => 'desc')
              )
          );

          $allComments = $this->Comment->find(
              'all',
              array(
                  'conditions' => array('Comment.article_id' => $slug1)
              )
          );

          $numberOfComments = count( $allComments );

      }
      else {
          $comments = array();
      }

      $notification = $this->Notification->find(
          'first',
          array(
              'conditions' => array('Notification.article_id' => $slug1, 'Notification.user_id' => $this->Session->read('Auth.User.id'))
          )
      );

      if ( !empty($notification) ) {
          $this->Notification->delete( $notification['Notification']['id'], false );
      }


      if( !$articlePage ) {
          throw new NotFoundException(__('Cet article n’apparait pas dans la base de données.'));
      }

      $this->set(compact('articlePage', 'comments', 'numberOfComments'));

    }

}
