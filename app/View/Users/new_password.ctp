<?php

    $this->assign('title', 'Nouveau mot de passe');
    $this->assign('description', 'Modification du mot de passe après avoir demandé une récupération de compte');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Nouveau mot de passe</h2></div>

    <div class='bloc bloc--padding'>

        <?php if($this->Session->check('Auth.User.id')): ?>

            <p class='message message--bad'>Vous êtes déjà connecté au site.</p>

        <?php else: ?>
            <p><?php echo $user['User']['username'] ?>, vous êtes sur le point de modifier votre mot de passe. Une fois cela fait, vous serez redigirez vers la page de connexion.</p>

            <?php echo $this->Flash->render(); ?>

            <div class="form">

                <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>
                <?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data', 'novalidate' => true)); ?>
                    <?php
                        echo $this->Form->input('password', array('label' => 'Mot de passe*', 'class' => 'input-password'));
                        echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => 'Confirmer le mot de passe*', 'class' => 'input-password no-past'));
                    ?>
                <?php echo $this->Form->end(__('Modifier mon mot de passe'));?>
            </div>

          <?php endif; ?>
    </div>

</section>
