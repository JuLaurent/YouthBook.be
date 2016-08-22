<?php

class Saga extends AppModel {

    public $name = 'Saga';

    public $hasMany = array(
        'Subscription'
    );

    public $belongsTo = array(
        'User'
    );

    public $hasAndBelongsToMany = array(
        'Book'
    );

    public $joinBookUser = array(
        array(
            'table' => 'yb_books_sagas',
            'alias' => 'BookSaga',
            'type' => 'inner',
            'conditions' => array(
                'Saga.id = BookSaga.saga_id'
            )
        ),
        array(
            'table' => 'yb_books',
            'alias' => 'Book',
            'type' => 'inner',
            'conditions' => array(
                'BookSaga.book_id = Book.id'
            )
        ),
        array(
            'table' => 'yb_books_users',
            'alias' => 'BookUser',
            'type' => 'inner',
            'conditions' => array(
                'Book.id = BookUser.book_id'
            )
        ),
        array(
            'table' => 'yb_users',
            'alias' => 'UserB',
            'type' => 'inner',
            'conditions' => array(
                'BookUser.user_id = UserB.id'
            )
        )
    );

    public $joinBookArticle = array(
        array(
            'table' => 'yb_books_sagas',
            'alias' => 'BookSaga',
            'type' => 'inner',
            'conditions' => array(
                'Saga.id = BookSaga.saga_id'
            )
        ),
        array(
            'table' => 'yb_books',
            'alias' => 'Book',
            'type' => 'inner',
            'conditions' => array(
                'BookSaga.book_id = Book.id'
            )
        ),
        array(
            'table' => 'yb_articles_books',
            'alias' => 'ArticleBookB',
            'type' => 'inner',
            'conditions' => array(
                'Book.id = ArticleBookB.book_id'
            )
        ),
        array(
            'table' => 'yb_articles',
            'alias' => 'Article',
            'type' => 'inner',
            'conditions' => array(
                'ArticleBookB.article_id = Article.id'
            )
        )
    );

    public $validate = array(
        'title' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un titre est requis.'
            ),
            'unique' => array(
                'rule'          => 'isUnique',
                'message'       => 'Une saga avec le même titre existe déjà.',
                'on'            => 'create'
            ),
            /*'isSimilar' => array(
                'rule'          => array( 'similarText', 'title'),
                'message'       => 'Un livre avec le même titre existe déjà.'
            )*/
        )

    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['title'])) {
            $this->data[$this->alias]['slug'] = Inflector::slug($this->data[$this->alias]['title'], '-');
        }

        foreach (array_keys($this->hasAndBelongsToMany) as $model){
      			if(isset($this->data[$this->name][$model])){
      				$this->data[$model][$model] = $this->data[$this->name][$model];
      				unset($this->data[$this->name][$model]);
      			}
    		}

        return true;
    }
}
