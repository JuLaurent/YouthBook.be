<?php

    $this->assign('title', 'Créer un compte');
    $this->assign('description', 'Création d’un compte');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Créer un compte</h2></div>

    <div class='bloc bloc--padding'>

        <?php if($this->Session->check('Auth.User.id')): ?>

            <p class='message message--bad'>Vous êtes déjà connecté au site.</p>

        <?php else: ?>

          <?php echo $this->Session->flash(); ?>

          <div class="form">

              <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>
              <?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data', 'novalidate' => true)); ?>
                  <?php
                      echo $this->Form->input('username', array('label' => 'Pseudo*', 'class' => 'input-text'));
                      echo $this->Form->input('password', array('label' => 'Mot de passe*', 'class' => 'input-password'));
                      echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => 'Confirmer le mot de passe*', 'class' => 'input-password'));
                      echo $this->Form->input('mail', array('label' => 'Adresse mail*', 'class' => 'input-text'));
                      echo $this->Form->input('confirm_mail', array('label' => 'Confirmer l’adresse mail*', 'class' => 'input-text'));
                      echo $this->Form->input('avatar', array('type' => 'file', 'label' => 'Avatar (au format png, jpeg ou gif)', 'class' => 'input-file'));
                      echo $this->Form->input('role', array('type' => 'hidden', 'value' => 'membre'));
                  ?>
              <?php echo $this->Form->end(__('Créer mon compte'));?>
          </div>

        <?php endif; ?>
    </div>

</section>
