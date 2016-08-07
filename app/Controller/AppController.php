<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components =
        array(
            'Brownie.BrwPanel',
            'DebugKit.Toolbar',
            'Flash',
            'RequestHandler',
            'Session',
        );

    public $helpers = array('Html', 'Flash', 'Form', 'SocialShare.SocialShare');

    public function beforeFilter() {
        parent::beforeFilter();

        if( $this->Session->read('errors') ) {
            $this->request->data = $this->Session->read('data');
            $this->Session->delete('data');

            foreach( $this->Session->read('errors') as $model => $errors ){
                $this->loadModel($model);
                $this->$model->validationErrors = $errors;
            }

            $this->Flash->error($this->Session->read('flash'));

            $this->Session->delete('errors');
            $this->Session->delete('flash');
        }
    }

    public function beforeRender() {
        $this->loadModel('Conversation');
        $this->loadModel('ConversationsUser');
        $this->loadModel('Notification');

        $numberNotSeenConversations = count($this->ConversationsUser->find(
            'all',
            array(
                'conditions' => array( 'ConversationsUser.user_id' => $this->Session->read('Auth.User.id'), 'ConversationsUser.seen' => false )
            )
        ));

        $notSeenConversations = $this->Conversation->find(
            'all',
            array(
                'joins' => $this->Conversation->joinUser,
                'conditions' => array( 'User.id' => $this->Session->read('Auth.User.id'), 'ConversationUser.seen' => false ),
                'limit' => 5,
                'order' => array('Conversation.modified' => 'desc')
            )
        );

        $numberNotSeenArticles = count($this->Notification->find(
            'all',
            array(
                'conditions' => array( 'Notification.user_id' => $this->Session->read('Auth.User.id')),
            )
        ));

        $notSeenArticles = $this->Notification->find(
            'all',
            array(
                'recursive' => 2,
                'conditions' => array( 'Notification.user_id' => $this->Session->read('Auth.User.id')),
                'limit' => 5,
                'order' => array('Article.created' => 'desc')
            )
        );

        $this->set(compact('numberNotSeenConversations', 'notSeenConversations', 'numberNotSeenArticles', 'notSeenArticles'));
    }

}
