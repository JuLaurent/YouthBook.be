<?php

    $this->assign('title', 'Nouvelle conversation');
    $this->assign('description', 'Création d’une nouvelle conversation');

?>

<?php echo $this->element('conversation-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Nouvelle conversation</h2></div>

    <div class='bloc bloc--padding'>
        <?php echo $this->Flash->render(); ?>

        <div class="form form--comment">
            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

            <noscript><p class='alert-message message--warning'>Attention, désactiver JavaScript vous empêchera d’utiliser les outils de mise en forme.</p></noscript>

            <?php
                echo $this->Form->create('Conversation', array('novalidate' => true));
                    echo $this->Form->input('title', array('label' => 'Titre*', 'class' => 'input-text input-text--comment'));
                    echo $this->Form->input('Conversation.User', array('label' => 'Interlocateur(s)*', 'multiple' => true, 'class' => 'form-select form-select--comment', 'data-placeholder' => 'Sélectionnez un ou plusieurs interlocateurs'));
                    echo $this->Wysiwyg->input('Message.0.content', array('label' => 'Message*', 'class' => 'form-textarea form-textarea--article wysi2'));
                    echo $this->Form->input('Message.0.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                echo $this->Form->end(__('Créer la conversation'));
            ?>
        </div>
    </div>

</section>
