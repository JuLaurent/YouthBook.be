<?php

    $this->assign('title', 'Se connecter');
    $this->assign('description', 'Page de connexion à son compte utilisateur');

?>

<section class='bloc'>

    <div class="page-title"><h2 class='beta page-title__item'>Se connecter</h2></div>

    <div class='bloc bloc--padding'>

        <?php if($this->Session->check('Auth.User.id')): ?>

            <p class='message message--bad'>Vous êtes déjà connecté au site.</p>

        <?php else: ?>

            <?php echo $this->Flash->render(); ?>

            <div class="form bloc">

                <?php
                    echo $this->Form->create('User', array('novalidate' => true));
                        echo $this->Form->input('username', array('label' => 'Pseudo', 'class' => 'input-text'));
                        echo $this->Form->input('password',  array('label' => 'Mot de passe', 'class' => 'input-password'));
                ?>
                <span class='bloc__password-link'>
                    <?php
                        echo $this->Html->link(
                            'Mot de passe oublié',
                            array('controller' => 'users', 'action' => 'forgottenPassword'),
                            array('title' => 'Aller à la page de mot de passe oublié', 'class' => 'link link--password')
                        );
                    ?>
                </span>
                <?php echo $this->Form->end(__('Se connecter')); ?>

            </div>

            <div>
                <p class='important'>Pas encore de compte ?</p>
                <div class='buttons'>
                    <span class='button'>
                        <?php echo $this->Html->link(
                                'Créez-le',
                                array('controller' => 'users', 'action' => 'add'),
                                array('title' => 'Aller à la page de création de compte')
                            );
                        ?>
                    </span>
                </div>
            </div>

        <?php endif; ?>
    </div>

</section>
