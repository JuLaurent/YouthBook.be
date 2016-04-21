<?php

class Saga extends AppModel {

    public $name = 'Saga';

    public $hasMany = array(
        'Book'
    );

    public $belongsTo = array(
        'User'
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
