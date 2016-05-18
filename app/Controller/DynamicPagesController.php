<?php

App::uses('AppController', 'Controller');

class DynamicPagesController extends AppController {

    public function home() {
        $this->loadModel('Article');
        $this->loadModel('Book');
        $this->loadModel('Type');

        $highlightedReview = $this->Article->find(
            'first',
            array(
                'joins' => $this->Article->joinType,
                'conditions' => array('Article.highlighted' => '1', 'Article.draft' => '0', 'Type.name' => 'critique'),
                'order' => array('Article.created' => 'desc')
            )
        );

        $recentReviews = $this->Article->find(
            'all',
            array(
                'limit' => 5,
                'joins' => $this->Article->joinType,
                'conditions' => array('Type.name' => 'critique', 'Article.draft' => 0),
                'group' => array('Article.id'),
                'order' => array('Article.created' => 'desc'))
        );

        $highlightedArticles = $this->Article->find(
            'all',
            array(
                'limit' => 8,
                'joins' => $this->Article->joinType,
                'conditions' => array('Article.highlighted' => '1', 'Article.draft' => 0, 'Type.name' => array('news', 'dossier', 'produit dérivé')),
                'group' => array('Article.id'),
                'order' => array('Article.created' => 'desc'))
        );

        $recentArticles = $this->Article->find(
            'all',
            array(
                'limit' => 10,
                'joins' => $this->Article->joinType,
                'conditions' => array('Article.draft' => 0, 'Type.name' => array('news', 'dossier', 'produit dérivé')),
                'group' => array('Article.id'),
                'order' => array('Article.created' => 'desc'))
        );

        $recentBooks = $this->Book->find(
            'all',
            array(
                'limit' => 8,
                'conditions' => array('Book.release_date <=' => date('Y-m-d')),
                'order' => array('Book.release_date' => 'desc')
            )
        );

        $this->set(compact('highlightedReview', 'recentReviews', 'highlightedArticles', 'recentArticles', 'recentBooks' ));
    }

    public function findBooks() {
        $this->loadModel('Book');

        if ( $this->request->is('ajax') ) {
            if ( $this->request->data['Book']['title'] != '' ) {
                $books = $this->Book->find(
                    'all',
                    array(
                        'recursive' => -1,
                        'conditions' => array( 'Book.title REGEXP' => '[\s\S]*' . $this->request->data['Book']['title'] . '[\s\S]*' ),
                        'order' => array( 'Book.title' => 'asc' )
                    )
                );
            }
            else {
                $books = '';
            }

            echo json_encode( $books );

            exit();
        }
    }

    public function search() {
        $this->loadModel('Book');
        $this->loadModel('Article');
        $this->loadModel('Type');

        if( $this->request->query['search'] != '' ) {
            $books = $this->Book->find(
                'all',
                array(
                    'conditions' => array( 'Book.title REGEXP' => '[\s\S]*' . $this->request->query['search'] . '[\s\S]*' ),
                    'order' => array('Book.title' => 'asc')
                )
            );

            $articles = $this->Article->find(
                'all',
                array(
                    'conditions' => array( 'Article.title REGEXP' => '[\s\S]*' . $this->request->query['search'] . '[\s\S]*' ),
                    'order' => array('Article.title' => 'asc')
                )
            );
        }
        else {
            $books = null;
            $articles = null;
        }

        $this->set(compact('books', 'articles' ));
    }

    public function about() {

    }
}
