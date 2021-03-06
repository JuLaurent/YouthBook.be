<?php

class ArticlesController extends AppController {
    public $helpers = array('Wysiwyg.Wysiwyg' => array('editor' => 'Tinymce'));

    public $components = array(
        'Auth'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }

    public function index($slug = null) {

        $this->loadModel('Type');

        if (!$slug) {
            throw new NotFoundException(__('Ce type d’articles n’existe pas.'));
        }

        $type = $this->Type->find(
            'first',
            array(
                'recursive' => -1,
                'conditions' => array('Type.slug' => $slug)
            )
        );

        $lastArticles = $this->Article->find(
            'all',
            array(
                'limit' => 4,
                'joins' => $this->Article->joinType,
                'conditions' => array('Article.highlighted' => '1', 'Article.draft' => 0, 'Type.slug' => $slug),
                'order' => array('Article.created' => 'desc'))
        );
        $articles = $this->Article->find(
            'all',
            array(
                'joins' => $this->Article->joinType,
                'conditions' => array('Article.draft' => 0, 'Type.slug' => $slug),
                'order' => array('Article.created' => 'desc')
            )
        );

        $this->set(compact('type', 'lastArticles', 'articles'));
    }

    public function addBeforeStepOne() {
        if ($this->request->is('post')) {

            if ($this->Article->saveAll($this->request->data, array('validate' => 'only'))){
                $this->Session->write('currentSessionData', $this->request->data);
                return $this->redirect(array('action' => 'addStepOne'));
            }
            else {
                $this->Flash->error('Vous ne pouvez pas créer d’article. Veuillez réessayer SVP.');
            }
        }
    }

    public function addStepOne() {
        $this->loadModel('Type');

        if( !empty( $this->Session->read('currentSessionData')['Article']['number_of_pages'] ) ) {
            $this->Session->delete('currentSessionData.Article.number_of_pages');
        }

        if( !empty( $this->Session->read('currentSessionData')['Article']['Type'] ) ) {
            $this->Session->delete('currentSessionData.Article.Type');
        }

        $this->set('types', $this->Article->Type->find('list'));

        if ($this->request->is('post')) {

            if ( !empty( $this->Session->read('currentSessionData') ) ) {
                $currentSessionData = Hash::merge( (array) $this->Session->read('currentSessionData'), $this->request->data);
            }
            else {
                $currentSessionData = $this->request->data;
            }

            if ($this->Article->saveAll($this->request->data, array('validate' => 'only'))){
                $this->Session->write('currentSessionData', $currentSessionData);
                return $this->redirect(array('action' => 'addStepTwo'));
            }
            else {
                $this->Flash->error('Vous n’avez sélectionné de type. Veuillez en sélectionner au moins un SVP');
            }
        }
    }

    public function addStepTwo() {
        $this->loadModel('Book');
        $this->loadModel('Type');

        $books = $this->Article->Book->find(
            'list',
            array(
                'order' => array('Book.title' => 'asc')
            )
        );

        $verif1 = in_array ( '1' , $this->Session->read('currentSessionData')['Article']['Type'] );
        $verif2 = in_array ( '3' , $this->Session->read('currentSessionData')['Article']['Type'] );
        $verif3 = in_array ( '2' , $this->Session->read('currentSessionData')['Article']['Type'] );
        $verif4 = in_array ( '4' , $this->Session->read('currentSessionData')['Article']['Type'] );

        $access = true;

        if( !$this->Session->read('currentSessionData')['Article']['Type'] ) {
            $access = false;
        }

        $this->set(compact('books', 'verif1', 'verif2', 'verif3', 'verif4', 'access'));

        if ($this->request->is('post')) {

            $this->Article->create();
            $currentSessionData = Hash::merge( (array) $this->Session->read('currentSessionData'), $this->request->data);

            if( $verif1 == true && $verif2 == false ) {
                $currentSessionData['Article']['title'] = $this->Book->findById($currentSessionData['Article']['Book'])['Book']['title'];
            }

            $this->Article->set($currentSessionData);

            if( $verif2 == true ) {
                if ($this->Article->validates()){
                    $this->Session->write('currentSessionData', $currentSessionData);
                    return $this->redirect(array('action' => 'addStepThree'));
                }
                else {
                    $this->Flash->error('Vous n’avez pas entré un nombre de pages. Veuillez en entrer un SVP', 'default', array( 'class' => 'message message--bad' ));
                }
            }
            else {
                if ($this->Article->saveAll($currentSessionData)) {
                    $this->Session->delete('currentSessionData');
                    return $this->redirect(array('controller' => 'users', 'action' => 'drafts'));
                }
                else {
                    $this->Flash->error('L’article n’a pas pu être ajouté. Veuillez réessayer SVP.');
                }
            }
        }
    }

    public function addStepThree() {

        $this->loadModel('Book');
        $this->loadModel('Type');

        $books = $this->Article->Book->find(
            'list',
            array(
                'order' => array('Book.title' => 'asc')
            )
        );

        $verif1 = in_array ( '1' , $this->Session->read('currentSessionData')['Article']['Type'] );
        $verif2 = in_array ( '3' , $this->Session->read('currentSessionData')['Article']['Type'] );

        $access = true;

        if( !$this->Session->read('currentSessionData')['Article']['number_of_pages'] ) {
            $access = false;
        }

        $this->set(compact('books', 'verif1', 'verif2', 'access'));

        if ($this->request->is('post')) {

            $this->Article->create();
            $currentSessionData = Hash::merge( (array) $this->Session->read('currentSessionData'), $this->request->data);

            if ($this->Article->saveAll($currentSessionData)) {
                $this->Session->delete('currentSessionData');
                return $this->redirect(array('controller' => 'users', 'action' => 'drafts'));
            } else {
                $this->Flash->error('L’article n’a pas pu être ajouté. Veuillez réessayer SVP.');
            }
        }
    }

    public function post($id = null) {

        $this->loadModel('Notification');
        $this->loadModel('Request');
        $this->loadModel('Saga');
        $this->loadModel('Subscription');
        $this->loadModel('User');

        $article = $this->Article->findById($this->request->data['Article']['id']);

        $request = $this->Request->findByBookId($article['Book'][0]['id']);

        $sagas = $this->Saga->find(
            'all',
            array(
                'joins' => $this->Saga->joinBookArticle,
                'conditions' => array('Article.id' => $article['Article']['id'])
            )
        );

        $sagasId = [];

        foreach ( $sagas as $saga ) {
            array_push( $sagasId, $saga['Saga']['id'] );
        }

        $subscriptions = $this->Subscription->find(
            'all',
            array(
                'conditions' => array(
                    array( 'Subscription.saga_id' => $sagasId )
                )
            )
        );

        $usersId = [];

        foreach ( $subscriptions as $subscription ) {
            array_push( $usersId, $subscription['User']['id'] );
        }

        $users = $this->User->find(
            'all',
            array(
                'recursive' => 0,
                'conditions' => array(
                    'OR' => array(
                        array( 'User.role' => 'administrateur' ),
                        array( 'User.id' => $usersId ),
                    )
                )
            )
        );

        if ( $this->request->is('post') || $this->request->is('put') ) {
            $notifications = array('Notification' => array(
                    'article_id' => $article['Article']['id'],
                    'User' => array()
                )
            );

            foreach($users as $user) {
                array_push($notifications['Notification']['User'], $user['User']['id']);
            }

            if ( $this->Article->save($this->request->data) ) {

                if ( !empty($request) ) {
                    $this->Request->save( array( 'Request' => array( 'id' => $request['Request']['id'], 'done' => 1, 'article_id' => $article['Article']['id'] )));
                }

                foreach($users as $user) {
                    $this->Notification->create();
                    $this->Notification->save( array( 'Notification' => array( 'article_id' => $article['Article']['id'], 'user_id' => $user['User']['id'] )));
                }

                $newArticle = $this->Article->findById($article['Article']['id']);
                return $this->redirect(array('controller' => 'articlePages', 'action' => 'view', 'slug1' => $newArticle['Article']['id'], 'slug2' => $newArticle['Article']['slug'], 'slug3' => '1'));

            }
        } else {
            $this->request->data = $this->Article->read(null, $article['Article']['id']);
        }
    }

    public function edit($slug1 = null, $slug2 = null) {
        $this->loadModel('Book');
        $this->loadModel('Type');

        if (!$slug1) {
            throw new NotFoundException(__('Cet article n’apparait pas dans la base de données.'));
        }

        $article = $this->Article->findById($slug1);

        $verif1 = false;
        $verif2 = false;
        $verif3 = false;
        $verif4 = false;

        foreach( $article['Type'] as $type ) {
            if ( in_array ( 'critique', $type ) ) {
                $verif1 = true;
            }
            else if ( in_array ( 'dossier', $type ) ) {
                $verif2 = true;
            }
            else if ( in_array ( 'news', $type ) ) {
                $verif3 = true;
            }
            else if ( in_array ( 'produit dérivé', $type ) ) {
                $verif4 = true;
            }
        }

        if ( !$article ) {
            throw new NotFoundException(__('Cet article n’apparait pas dans la base de données.'));
        }

        $access = true;

        if ( $article['User']['id'] != $this->Session->read('Auth.User.id') && $this->Session->read('Auth.User.role') != 'administrateur' && $this->Session->read('Auth.User.role') != 'modérateur' ) {
            $access = false;
        }

        $books = $this->Article->Book->find(
            'list',
            array(
                'order' => array('Book.title' => 'asc')
            )
        );

        $this->set(compact('article', 'books', 'verif1', 'verif2', 'verif3', 'verif4', 'access'));

        $this->Article->id = $article['Article']['id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Article->saveAll($this->request->data)) {

                $newArticle = $this->Article->findById($article['Article']['id']);
                return $this->redirect(array('controller' => 'articlePages', 'action' => 'view', 'slug1' => $newArticle['Article']['id'], 'slug2' => $newArticle['Article']['slug'], 'slug3' => '1'));

            } else {
                $this->Flash->error('L’article n’a pas pu être été édité. Veuillez réessayer SVP.');
            }
        } else {
            $this->request->data = $this->Article->read(null, $article['Article']['id']);
        }
    }

    public function delete() {

        $this->loadModel('ArticlePage');
        $this->loadModel('Comment');
        $this->loadModel('Notification');
        $this->loadModel('Request');

        $articleId = $this->request->data['Article']['id'];

        $requests = $this->Request->findByArticleId( $articleId );
        $comments = $this->Comment->findByArticleId( $articleId );
        $notifications = $this->Notification->findByArticleId( $articleId );

        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ( $this->ArticlePage->deleteAll(array('article_id' => $articleId), false) ) {

            if ( !empty( $comments ) ) {
                $this->Comment->deleteAll(array('article_id' => $articleId), false);
            }

            if ( !empty( $requests ) ) {
                $this->Request->deleteAll( array('article_id' => $articleId), false );
            }

            if ( !empty( $notifications ) ) {
                $this->Notification->deleteAll( array('article_id' => $articleId), false );
            }

            $this->Article->delete( $articleId );

            if ( $this->request->is('ajax') ) {
                exit();
            }
            else {
                return $this->redirect(array('controller' => 'dynamicPages', 'action' => 'home'));
            }
        }
        else {
            return $this->redirect(array('controller' => 'dynamicPages', 'action' => 'home'));
        }
    }

}
