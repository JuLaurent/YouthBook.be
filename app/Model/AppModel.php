<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public $actsAs =
        array(
            'Containable',
            'Brownie.BrwPanel'
        );

    /*public function similarText($field) {
        foreach($this->Book->find() as $book) {
            if($book['title'] == $field) {
                return true;
            }
            else {
                return false;
            }
        }

    }*/

    public function compareFields($field1, $field2) {

        if (is_array($field1)) {
			       $field1 = key($field1);
		    }

    		if (isset($this->data[$this->alias][$field1]) && isset($this->data[$this->alias][$field2]) &&
    			$this->data[$this->alias][$field1] == $this->data[$this->alias][$field2]) {
            return true;
    		}
        else {
            return false;
        }
	  }

    public function numberBetween($field1, $field2, $field3) {

        if (is_array($field1)) {
             $field1 = key($field1);
        }

        if (isset($this->data[$this->alias][$field1]) && $this->data[$this->alias][$field1] >= $field2 && $this->data[$this->alias][$field1] <= $field3) {
            return true;
    		}
        else {
            return false;
        }
	  }

    public function sameName($field) {

        if (is_array($field)) {
             $field = key($field);
        }

        $object = $this->findById($this->data[$this->alias]['id']);

        if ($this->data[$this->alias][$field]['name'] != '' && $this->data[$this->alias][$field]['name'] == $object[$this->alias][$field]) {
            return false;
    		}
        else {
            return true;
        }
	  }

}
