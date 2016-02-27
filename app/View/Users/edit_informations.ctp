<?php

    $this->assign('title', 'Modifier profil');
    $this->assign('description', 'Modifier les informations de son profil');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Modifier son profil</h2></div>

    <div class='bloc bloc--padding'>

        <?php echo $this->Session->flash(); ?>

        <div class="form form--right-part">

            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

            <?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data', 'novalidate' => true));?>
                <?php
                    echo $this->Form->input('mail', array('label' => 'Modifier l’adresse mail', 'class' => 'input-text'));
                ?>
                <div class='form__bloc'>
                    <span class='form__span'>Votre avatar actuel</span>
                    <span class='form__image user__avatar'>
                        <?php
                            if($this->Session->read('Auth.User.avatar')) {
                                echo $this->Html->image('avatars/' . $this->Session->read('Auth.User.id') . '/thumb_' . $this->Session->read('Auth.User.avatar'), array('alt' => 'Votre avatar', 'srcset' => $this->webroot . 'img/avatars/' . $this->Session->read('Auth.User.id') . '/thumb_' . $this->Session->read('Auth.User.avatar') . ' 1x, ' . $this->webroot . 'img/avatars/' . $this->Session->read('Auth.User.id') . '/thumbHR_' . $this->Session->read('Auth.User.avatar') . ' 2x', 'width' => '71', 'height' => '71'));
                            }
                            else {
                                echo $this->Html->image('avatars/noAvatar.png', array('alt' => 'Avatar de substitution', 'srcset' => $this->webroot . 'img/avatars/thumb_noAvatar.png 1x, ' . $this->webroot . 'img/avatars/thumbHR_noAvatar.png 2x', 'width' => '71', 'height' => '71'));
                            }
                        ?>
                    </span>
                </div>
                <?php
                    echo $this->Form->input('avatar', array('type' => 'file', 'label' => 'Avatar (au format png, jpeg ou gif)', 'class' => 'input-file'));
                    echo $this->Form->input('id', array('type' => 'hidden'));
                ?>
            <?php echo $this->Form->end(__('Modifier mon profil'));?>

        </div>
    </div>

</section>
