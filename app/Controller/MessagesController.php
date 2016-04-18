<?php

class MessagesController extends AppController {
    public $helpers = array('Wysiwyg.Wysiwyg' => array('editor' => 'Tinymce'));

    public function add() {

        if ($this->request->is('post')) {
            $this->Message->create();

            if ($this->Message->save($this->request->data)) {
                return $this->redirect($this->referer());
            }
            else {
                $this->Session->write('errors.Message', $this->Message->validationErrors);
                $this->Session->write('data', $this->request->data);
                $this->Session->write('flash', 'Le message n’a pas pu être publié. Veuillez réessayer SVP.');

                return $this->redirect($this->referer());
            }
        }
    }
}
