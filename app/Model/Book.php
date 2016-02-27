<?php
class Book extends AppModel {
    public $name = 'Book';
    public $actsAs = array(
        'Upload.Upload' => array(
            'cover' => array(
                'path' => '{ROOT}webroot{DS}img{DS}covers{DS}',
                'thumbnailMethod' => 'php',
                'thumbnailSizes' => array(
                    'small' => '252x400',
                    'normal' => '564x880',
                ),
                'deleteOnUpdate' => 'true'
            )
        )
    );
    public $hasMany = array(
        'Request'
    );
    public $hasAndBelongsToMany = array(
        'Article',
        'User'
    );
    public $joinUser = array(
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
            'alias' => 'User',
            'type' => 'inner',
            'conditions' => array(
                'BookUser.user_id = User.id'
            )
        )
    );
    public $validate = array(
        'isbn' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'L’ISBN est requis.'
            ),
            'isNumeric' => array(
                'rule'          => array('naturalNumber', true),
                'message'       => 'L’ISBN ne doit contenir que des chiffres.'
            ),
            'length' => array(
                'rule'          => array('between', 10, 13),
                'message'       => 'L’ISBN doit contenir 10 ou 13 caractères.'
            ),
            'unique' => array(
                'rule'          => array( 'uniqueIsbn', 'isbn'),
                'message'       => 'Un livre avec le même ISBN existe déjà.'
            )
        ),
        'isbn10' => array(
            'isNumeric' => array(
                'rule'          => array('naturalNumber', true),
                'message'       => 'L’ISBN ne doit contenir que des chiffres.',
                'allowEmpty'    => true
            ),
            'length' => array(
                'rule'          => array('between', 10, 10),
                'message'       => 'L’ISBN doit contenir 10 chiffres.'
            ),
            'unique' => array(
                'rule'          => array( 'uniqueIsbn', 'isbn'),
                'message'       => 'Un livre avec le même ISBN existe déjà.',
                'on'            => 'create'
            )
        ),
        'isbn13' => array(
            'isNumeric' => array(
                'rule'          => array('naturalNumber', true),
                'message'       => 'L’ISBN ne doit contenir que des chiffres',
                'allowEmpty'    => true
            ),
            'length' => array(
                'rule'          => array('between', 13, 13),
                'message'       => 'L’ISBN doit contenir 13 chiffres dont "978" en tête.'
            ),
            'unique' => array(
                'rule'          => array( 'uniqueIsbn', 'isbn'),
                'message'       => 'Un livre avec le même ISBN existe déjà.',
                'on'            => 'create'
            )
        ),
        'title' => array(
            'required' => array(
                'rule'          => array('notBlank'),
                'message'       => 'Un titre est requis.'
            ),
            'unique' => array(
                'rule'          => 'isUnique',
                'message'       => 'Un livre avec le même titre existe déjà.',
                'on'            => 'create'
            ),
            /*'isSimilar' => array(
                'rule'          => array( 'similarText', 'title'),
                'message'       => 'Un livre avec le même titre existe déjà.'
            )*/
        ),
        'cover' => array(
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
        'pages' => array(
            'isNumeric' => array(
                'rule'          => array('naturalNumber', true),
                'message'       => 'Le nombre de pages ne doit contenir que des chiffres.'
            )
        )
    );
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['title'])) {
            $this->data[$this->alias]['slug'] = Inflector::slug($this->data[$this->alias]['title'], '-');
        }
        return true;
    }
    public function uniqueIsbn($field) {
        $field = key($field);
        $books = $this->find('all');
        $isOk = true;
        foreach($books as $book){
            if($book['Book']['isbn10'] == $this->data[$this->alias][$field] || $book['Book']['isbn13'] == $this->data[$this->alias][$field]) {
                $isOk = false;
            }
        }
        return $isOk;
    }
    /* public function similarText($field){
        $books = $this->find('all');
        $isOk = true;
        foreach($books as $book){
            similar_text ( $book['Book']['title'] , $field['title'], $percent );
            debug($percent);
        }
    } */
}
