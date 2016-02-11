<?php

    $this->assign('title', 'Éditer profil');
    $this->assign('description', 'Édition de son mot de passe');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Modifier son mot de passe</h2></div>

    <div class='bloc bloc--padding'>

        <?php echo $this->Session->flash(); ?>

        <div class="form form--right-part">

            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

            <?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data', 'novalidate' => true));?>
                <?php
                    echo $this->Form->input('password', array('label' => 'Modifier le mot de passe', 'value' => '', 'class' => 'input-password'));
                    echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => 'Confirmer le mot de passe', 'class' => 'input-password'));
                    echo $this->Form->input('id', array('type' => 'hidden'));
                ?>
            <?php echo $this->Form->end(__('Modifier mon mot de passe'));?>

        </div>
    </div>

</section>
