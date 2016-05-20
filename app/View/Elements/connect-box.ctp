<div class='popup-box popup-box--connect'>
    <span class='popup-box__filter'></span>
    <section class='popup-box__content'>
        <div class="page-title"><h2 class='beta page-title__item'>Se connecter</h2></div>
        <div class="form form--popup-box">
            <?php
                echo $this->Form->create('User', array('novalidate' => true, 'url' => array('controller' => 'users', 'action' => 'login')));
                    echo $this->Form->input('username', array('label' => 'Pseudo', 'class' => 'input-text input-text--popup-box'));
                    echo $this->Form->input('password',  array('label' => 'Mot de passe', 'class' => 'input-password input-password--popup-box'));
                echo $this->Form->end(__('Se connecter'));
            ?>
        </div>
        <!-- <?php
            echo $this->Html->link(
                'Envoyer mail',
                array('controller' => 'dynamicPages', 'action' => 'newPassword'),
                array('title' => 'Aller à la page de connexion')
            );
        ?> -->
    </section>
</div>
