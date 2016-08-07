<?php

class NotificationsController extends AppController {

    public $components = array(
        'Auth'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny();
    }

    public function index() {
        $articles = $this->Notification->find(
            'all',
            array(
                'recursive' => 2,
                'conditions' => array( 'Notification.user_id' => $this->Session->read('Auth.User.id')),
                'order' => array('Article.created' => 'desc')
            )
        );

        $this->set(compact('articles'));
    }

}
