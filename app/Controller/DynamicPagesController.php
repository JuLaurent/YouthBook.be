<?php

App::uses('AppController', 'Controller');

class DynamicPagesController extends AppController {
    public $helpers = array('Wysiwyg.Wysiwyg' => array('editor' => 'Tinymce'));

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

    public function countNotSeenConversations() {
        $this->loadModel('ConversationsUser');

        if ( $this->request->is('ajax') ) {
            $numberNotSeenConversations = count($this->ConversationsUser->find(
                'all',
                array(
                    'conditions' => array( 'ConversationsUser.user_id' => $this->Session->read('Auth.User.id'), 'ConversationsUser.seen' => false )
                )
            ));

            echo json_encode( $numberNotSeenConversations );

            exit();
        }
    }

    public function contact() {
        $this->loadModel('Contact');

        if ( $this->request->is('post') ) {
            $this->Contact->set($this->request->data);

            if ($this->Contact->validates()) {
                App::uses('CakeEmail', 'Network/Email');

                if ( $this->request->data['Contact']['subject'] == '' ) {
                    $this->request->data['Contact']['subject'] = 'Contact';
                }

                $Email = new CakeEmail('smtp');
                $Email->viewVars(array('mailData' => $this->request->data));
                $Email->template('contact', 'default');
                $Email->emailFormat('html');
                $Email->from(array($this->request->data['Contact']['mail'] => $this->request->data['Contact']['name']));
                $Email->to('contact@youthbook.be');
                $Email->subject($this->request->data['Contact']['subject']);

                $Email->attachments(array(
                    'logo.png' => array(
                        'file' => WWW_ROOT . '/img/icons/logo.png',
                        'mimetype' => 'image/png',
                        'contentId' => 'logo'
                    )
                ));

                $Email->send();

                $this->Flash->success(__('Votre message a bien été envoyé.'));
                return $this->redirect($this->referer());
            }
            else {
                $this->Session->write('errors.Contact', $this->Contact->validationErrors);
                $this->Session->write('data', $this->request->data);
                $this->Session->write('flash', 'Le mail n’a pas pu être envoyé. Veuillez réessayer SVP.');

                return $this->redirect($this->referer());
            }
        }
    }

    /* public function mail() {
        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail('smtp');
        $Email->template('new', 'default');
        $Email->emailFormat('html');
        $Email->from(array('contact@youthbook.be' => 'YouthBook.be'));
        $Email->to('');
        $Email->subject('YouthBook.be a été mis à jour');

        $Email->attachments(array(
            'logo.png' => array(
                'file' => WWW_ROOT . '/img/icons/logo.png',
                'mimetype' => 'image/png',
                'contentId' => 'logo'
            )
        ));

        $Email->send();

        return $this->redirect($this->referer());
    } */


}
