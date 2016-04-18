<?php

class Article extends AppModel {

    public $name = 'Article';

    public $hasOne = array(
        'Request'
    );

    public $hasMany = array(
        'ArticlePage',
        'Comment'
    );

    public $belongsTo = array(
        'User'
    );

    public $hasAndBelongsToMany = array(
        'Book',
        'Type'
    );

    public $joinType = array(
        array(
            'table' => 'yb_articles_types',
            'alias' => 'ArticleType',
            'type' => 'inner',
            'conditions' => array(
                'Article.id = ArticleType.article_id'
            )
        ),
        array(
            'table' => 'yb_types',
            'alias' => 'Type',
            'type' => 'inner',
            'conditions' => array(
                'ArticleType.type_id = Type.id'
            )
        )
    );

    public $joinBookType = array(
        array(
            'table' => 'yb_articles_types',
            'alias' => 'ArticleType',
            'type' => 'inner',
            'conditions' => array(
                'Article.id = ArticleType.article_id'
            )
        ),
        array(
            'table' => 'yb_types',
            'alias' => 'Type',
            'type' => 'inner',
            'conditions' => array(
                'ArticleType.type_id = Type.id'
            )
        ),
        array(
            'table' => 'yb_articles_books',
            'alias' => 'ArticleBook',
            'type' => 'inner',
            'conditions' => array(
                'Article.id = ArticleBook.article_id'
            )
        ),
        array(
            'table' => 'yb_books',
            'alias' => 'Book',
            'type' => 'inner',
            'conditions' => array(
                'ArticleBook.book_id = Book.id'
            )
        )
    );

    public $actsAs = array(
        'Upload.Upload' => array(
            'thumbnail' => array(
                'path' => '{ROOT}webroot{DS}img{DS}articlesThumbnails{DS}',
                'thumbnailMethod' => 'php',
                'thumbnailSizes' => array(
                    'bigHR' => '1500x700',
                    'big' => '750x350',
                    'normalHR' => '720x320',
                    'normal' => '360x160',
                    'smallHR' => '564x350',
                    'small' => '282x175'
                ),
                'deleteOnUpdate' => 'true'
            )
        )
    );

    public $validate = array(
        'title' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un titre est requis.'
            )
        ),
        'rating' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Une note (sur 5) est requise.'
            ),
            'isNumeric' => array(
                'rule'          => array('naturalNumber', true),
                'message'       => 'La note doit être un nombre',
                'allowEmpty'    => true
            ),
            'between' => array(
                'rule'          => array('numberBetween', 0, 5),
                'message'       => 'La note doit être comprise entre 0 et 5.'
            )
        ),
        'number_of_pages' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un nombre de pages est requis.'
            ),
            'isNumeric' => array(
                'rule'          => array('naturalNumber', true),
                'message'       => 'Le nombre de pages doit être un nombre',
                'allowEmpty'    => true
            ),
            'between' => array(
                'rule'          => array('numberBetween', 1, 10),
                'message'       => 'Le nombre de pages doit être compris entre 1 et 10.'
            )
        ),
        'thumbnail' => array(
            'valid' => array(
                'rule'          => array('isValidExtension', array('gif', 'jpeg', 'png', 'jpg'), false),
                'message'       => 'Votre image doit avoir un format valide.'
            ),
            'sameName' => array(
                'rule'          => array('sameName'),
                'message'       => 'Une image avec ce nom existe déjà.',
                'on'            => 'update'
            )
        ),
        'Type' => array(
            'rule'              => array('multiple', array('min' => 1)),
            'message'           => 'Vous devez sélectionner au moins un type d’article.'
        ),
        'Book' => array(
            'rule'              => array('multiple', array('min' => '1')),
            'message'           => 'Vous devez sélectionné au moins un livre.'
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
