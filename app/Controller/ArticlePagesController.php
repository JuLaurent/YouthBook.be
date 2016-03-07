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

      if($articlePage['ArticlePage']['page_number'] == $articlePage['Article']['number_of_pages']) {
          $comments = $this->Comment->find(
              'all',
              array(
                  'conditions' => array('Comment.article_id' => $slug1)
              )
          );
      }
      else {
          $comments = array();
      }


      if( !$articlePage ) {
          throw new NotFoundException(__('Cet article n’apparait pas dans la base de données.'));
      }

      $this->set(compact('articlePage', 'comments'));

    }

}
