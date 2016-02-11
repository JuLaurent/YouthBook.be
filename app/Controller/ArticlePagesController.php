<?php

class ArticlePagesController extends AppController {

    public $components = array(
        'Auth'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
    }

		public function view($slug1 = null, $slug2 = null, $slug3 = null) {

      if (!$slug1 && !$slug2) {
          throw new NotFoundException(__('Cet article n’apparait pas dans la base de données.'));
      }

      $articlePage = $this->ArticlePage->find(
          'first',
          array(
              'recursive' => '2',
              'conditions' => array('ArticlePage.page_number' => $slug3, 'Article.id' => $slug1, 'Article.slug' => $slug2)
          )
      );

      if( !$articlePage ) {
          throw new NotFoundException(__('Cet article n’apparait pas dans la base de données.'));
      }

      $this->set(compact('articlePage'));

    }

}
