<?php

    $this->assign('title', 'Contact');
    $this->assign('description', 'Formulaire de contact');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Contact</h2></div>

    <div class='bloc bloc--padding'>
        <p>Une question ? Une remarque ? Une suggestion ? Contactez-nous.</p>

        <?php echo $this->Flash->render(); ?>

        <div class="form form--article">
            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

            <?php
                echo $this->Form->create('Contact', array('url' => array('controller' => 'dynamicPages', 'action' => 'contact'), 'novalidate' => true));
                    echo $this->Form->input('mail', array('type' => 'email', 'label' => 'Adresse mail*', 'class' => 'input-text input-text--article'));
                    echo $this->Form->input('name', array('label' => 'Nom et prénom*', 'class' => 'input-text input-text--article'));
                    echo $this->Form->input('subject', array('label' => 'Sujet', 'class' => 'input-text input-text--article'));
                    echo $this->Wysiwyg->input('text', array('label' => 'Message*', 'class' => 'form-textarea form-textarea--article wysi2'));
                echo $this->Form->end(__('Envoyer le mail'));
            ?>
        </div>
    </div>

</section>
