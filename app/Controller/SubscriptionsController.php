<?php

class SubscriptionsController extends AppController {

    public function subscribe() {

        if ( $this->request->is('post') ) {
            $this->Subscription->create();
            if ( $this->Subscription->save($this->request->data) ) {

                if ( $this->request->is('ajax') ) {
                    exit();
                }
                else {
                    return $this->redirect($this->referer());
                }
            }
            else {
                return $this->redirect($this->referer());
            }
        } else {
            return $this->redirect($this->referer());
        }
    }

    public function unsubscribe() {

        $subscription = $this->Subscription->find(
            'first',
            array(
                'conditions' => array('Subscription.user_id' => $this->request->data['Subscription']['user_id'], 'Subscription.saga_id' => $this->request->data['Subscription']['saga_id'])
            )
        );

        if ($this->request->is('post')) {

            if ( $this->Subscription->delete( $subscription['Subscription']['id'], false ) ) {
                if ( $this->request->is('ajax') ) {
                    exit();
                }
                else {
                    return $this->redirect($this->referer());
                }
            }
        }

    }

}
