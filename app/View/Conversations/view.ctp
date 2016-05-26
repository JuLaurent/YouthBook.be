<?php

    $this->assign('title', $conversation['Conversation']['title']);
    $this->assign('description', 'Conversation' . $conversation['Conversation']['title']);

?>

<?php echo $this->element('conversation-nav'); ?>

<section class='right-part' itemscope itemprop='https://schema.org/Conversation'>

    <div class='page-title'><h2 class='beta page-title__item' itemprop='name'><?php echo $conversation['Conversation']['title'] ?></h2></div>

    <div class='bloc bloc--padding bloc--comments clearfix'>

        <div class='comments' itemprop='isPartOf' itemscope itemtype='https://schema.org/Message'>
            <?php foreach( $messages as $message ): ?>
                <div class='comment'>
                    <div class='clearfix'>
                        <span class='user__avatar user__avatar--article comment__avatar'>
                            <?php
                                if( $message['User']['avatar'] ) {
                                    echo $this->Html->image('avatars/' . $message['Message']['user_id'] . '/small_' . $message['User']['avatar'], array('alt' => 'Votre avatar', 'srcset' => $this->webroot . 'img/avatars/' . $message['Message']['user_id'] . '/small_' . $message['User']['avatar'] . ' 1x, ' . $this->webroot . 'img/avatars/' . $message['Message']['user_id'] . '/smallHR_' . $message['User']['avatar'] . ' 2x', 'width' => '48', 'height' => '48'));
                                }
                                else {
                                    echo $this->Html->image('avatars/small_noAvatar.png', array('alt' => 'Avatar de substitution', 'srcset' => $this->webroot . 'img/avatars/small_noAvatar.png 1x, ' . $this->webroot . 'img/avatars/smallHR_noAvatar.png 2x', 'width' => '48', 'height' => '48'));
                                }
                            ?>
                        </span>
                        <div class='comment__info'>
                            <span class='comment__username' itemprop='sender'><?php echo $message['User']['username'] ?></span>
                            <span class='comment__date' itemprop='dateSent'><?php echo $this->Time->format('d/m/Y G:H:s', $message['Message']['created']) ?></span>
                        </div>
                    </div>
                    <div class='comment__content' itemprop='text'><?php echo $message['Message']['content'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <section>
            <div class='bloc-title'><h3>Ajouter un message</h3></div>

            <?php echo $this->Flash->render(); ?>

            <div class="form form--comment">
                <?php
                    echo $this->Form->create('Conversation', array('url' => array('controller' => 'conversations', 'action' => 'addMessage'), 'novalidate' => true));
                        echo $this->Wysiwyg->input('Message.0.content', array('label' => 'Message*', 'class' => 'form-textarea form-textarea--article wysi2'));
                        echo $this->Form->input('Message.0.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                        echo $this->Form->input('id', array('type' => 'hidden', 'value' => $conversation['Conversation']['id']));
                    echo $this->Form->end(__('Envoyer le message'));
                ?>
            </div>

        </section>
    </div>

</section>
