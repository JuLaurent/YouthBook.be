<?php

    $this->assign('title', 'Mot de passe oublié');
    $this->assign('description', 'Page de demande de récupération de compte après avoir oublié son mot de passe');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Mot de passe oublié</h2></div>

    <div class='bloc bloc--padding'>

        <?php if($this->Session->check('Auth.User.id')): ?>

            <p class='message message--bad'>Vous êtes déjà connecté au site.</p>

        <?php else: ?>
            <p>Vous avez oublié votre mot de passe ? Complétez ce formulaire et les instructions pour récupérer votre compte vous seront envoyées par mail.</p>

            <?php echo $this->Flash->render(); ?>

            <div class="form">

                <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>
                <?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data', 'novalidate' => true)); ?>
                    <?php
                        echo $this->Form->input('verif_username', array('label' => 'Pseudo*', 'class' => 'input-text'));
                        echo $this->Form->input('verif_mail', array('label' => 'Adresse mail*', 'class' => 'input-text'));

                    ?>
                <?php echo $this->Form->end(__('Envoyer la demande'));?>
            </div>

        <?php endif; ?>
    </div>

</section>
