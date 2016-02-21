<?php

class BooksController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array(
        'Auth',
        'GoogleAPI.GoogleAPI' => array(
            'Service' => array(
                'Books'
            )
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'articles');
    }

    public function index($slug = null) {

        $alphabet = array('0-9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

        if($slug == '0-9') {
            $slug = '[0-9]';
        }

        $lastBooks = $this->Book->find(
            'all',
            array(
                'limit' => 8,
                'order' => array('Book.created' => 'desc'))
        );

        $books = $this->Book->find(
            'all',
            array(
                'conditions' => array( 'Book.title REGEXP' => '^' . $slug . '.*' ),
                'order' => array('Book.title' => 'asc')
            )
        );

        $firstLetters = $this->Book->query("SELECT DISTINCT SUBSTR( title, 1, 1) as firstLetter FROM yb_books ORDER BY firstLetter ASC;");

        $this->set(compact('lastBooks', 'books', 'alphabet', 'firstLetters'));
    }

    public function view($slug = null) {

        $this->loadModel('Article');
        $this->loadModel('Request');
        $this->loadModel('Type');

        if (!$slug) {
            throw new NotFoundException(__('Ce livre n’apparait pas dans la base de données.'));
        }

        $book = $this->Book->findBySlug($slug);

        $latestReviews = $this->Article->find(
            'all',
            array(
                'limit' => 10,
                'joins' => $this->Article->joinBookType,
                'conditions' => array('Article.draft' => 0, 'Book.slug' => $slug, 'Type.name' => 'critique'),
            )
        );

        $latestArticles = $this->Article->find(
            'all',
            array(
                'limit' => 10,
                'joins' => $this->Article->joinBookType,
                'group' => array('Article.id'),
                'conditions' => array('Article.draft' => 0, 'Book.slug' => $slug, 'Type.name' => array('news', 'dossier', 'produit dérivé')),
            )
        );

        $inUserCollection = false;

        foreach( $book['User'] as $user ) {

            $inUserCollection = in_array( $this->Session->read('Auth.User.id'), $user );

            if( $inUserCollection == true ) {
                break;
            }
        }

        if (!$book) {
            throw new NotFoundException(__('Ce livre n’apparait pas dans la base de données.'));
        }

        $request = $this->Request->findByBookId($book['Book']['id']);

        $requestedByUser = false;

        if(!empty($request)) {
            foreach( $request['User'] as $user ) {

                $requestedByUser = in_array( $this->Session->read('Auth.User.id'), $user );

                if( $requestedByUser == true ) {
                    break;
                }
            }
        }

      $this->set(compact('book', 'latestReviews', 'latestArticles', 'inUserCollection', 'requestedByUser'));
    }

    public function articles($slug1 = null, $slug2 = null) {

        $this->loadModel('Article');
        $this->loadModel('Type');

        if (!$slug1 && !$slug2) {
            throw new NotFoundException(__('Cette page n’existe pas.'));
        }

        $book = $this->Book->findBySlug($slug1);

        if( $slug2 == 'critiques' ) {
            $articles = $this->Article->find(
                'all',
                array(
                    'joins' => $this->Article->joinBookType,
                    'conditions' => array('Article.draft' => 0, 'Book.slug' => $slug1, 'Type.name' => 'critique'),
                )
            );
        }
        else if( $slug2 == 'articles' ) {
            $articles = $this->Article->find(
                'all',
                array(
                    'joins' => $this->Article->joinBookType,
                    'group' => array('Article.id'),
                    'conditions' => array('Article.draft' => 0, 'Book.slug' => $slug1, 'Type.name' => array('news', 'dossier', 'produit dérivé')),
                )
            );
        }

        if (!$book) {
            throw new NotFoundException(__('Ce livre n’apparait pas dans la base de données.'));
        }

      $this->set(compact('book', 'articles', 'slug2'));
    }

    public function add() {
    }

    public function addWithIsbn() {

        $this->Session->delete('book');

        if ($this->request->is('post')) {
            $this->Book->set($this->request->data);

            if ($this->Book->validates()){
                $book = $this->GoogleAPI->Service['Books']->volumes->listVolumes($this->request->data['Book']['isbn'], array('langRestrict' => 'fr'))['items'][0]['modelData']['volumeInfo'];

                if($book != null) {
                    $this->Session->write('book', $book);
                    return $this->redirect(array('action' => 'addWithoutIsbn'));
                }
                else {
                    $this->Session->setFlash('Aucun livre ne correspond à cet ISBN. Veuillez corriger l’erreur SVP.', 'default', array( 'class' => 'message message--bad' ));
                }
            }
            else {
                $this->Session->setFlash('Il y a un problème avec l’ISBN entré. Veuillez corriger l’erreur SVP.', 'default', array( 'class' => 'message message--bad' ));
            }
        }
    }

    public function addWithoutIsbn() {
        if ($this->request->is('post')) {
            $this->Book->create();
            if ($this->Book->save($this->request->data)) {
                $this->Session->delete('book');

                $newBook = $this->Book->findByTitle($this->request->data['Book']['title']);

                return $this->redirect(array('action' => 'view', 'slug' => $newBook['Book']['slug']));
            } else {
                $this->Session->setFlash('Le livre n’a pas pu être ajouté. Veuillez réessayer SVP.', 'default', array( 'class' => 'message message--bad' ));
            }
        }
    }

    public function edit($slug = null) {
        $this->loadModel('Article');
        $this->loadModel('Type');

        if (!$slug) {
            throw new NotFoundException(__('Ce livre n’apparait pas dans la base de données.'));
        }

        $book = $this->Book->findBySlug($slug);

        if (!$book) {
            throw new NotFoundException(__('Ce livre n’apparait pas dans la base de données.'));
        }

        $access = true;

        if ($book['Book']['creator_id'] != $this->Session->read('Auth.User.id') && $this->Session->read('Auth.User.role') != 'administrateur' && $this->Session->read('Auth.User.role') != 'modérateur') {
            $access = false;
        }

        $this->set(compact('book', 'access'));

        $this->Book->id = $book['Book']['id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Book->save($this->request->data)) {

                $newBook = $this->Book->find(
                    'first',
                    array(
                        'conditions' => array('Book.id' => $book['Book']['id']),
                    )
                );

                return $this->redirect(array('action' => 'view', 'slug' => $newBook['Book']['slug']));

            } else {
                $this->Session->setFlash('La fiche n’a pas pu être été éditée. Veuillez réessayer SVP.', 'default', array( 'class' => 'message message--bad' ));
            }
        } else {
            $this->request->data = $this->Book->read(null, $book['Book']['id']);
        }
    }

    public function addToCollection() {

        $book = $this->Book->findById($this->request->data['Book']['id']);
        $this->Book->id = $book['Book']['id'];

        if ($this->request->is('post')) {
            if ($this->Book->save($this->request->data)) {
                return $this->redirect(array('action' => 'view', 'slug' => $book['Book']['slug']));
            }
        }
    }

    public function removeFromCollection() {

        $book = $this->Book->findById($this->request->data['Book']['id']);

        if ($this->request->is('post')) {
            $this->Book->query('DELETE from yb_books_users WHERE book_id = "' . $this->request->data['Book']['id'] . '"AND user_id = "' . $this->request->data['User']['id'] . '"');
            return $this->redirect(array('action' => 'view', 'slug' => $book['Book']['slug']));
        }
    }
}
