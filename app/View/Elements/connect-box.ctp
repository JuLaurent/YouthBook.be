<div class='popup-box popup-box--connect'>
    <span class='popup-box__filter'></span>
    <div class='popup-box__content'>
        <span class='popup-box__close'>
            <button class='popup-box__close-button'><span class="fa fa-times" aria-hidden="true"></span></button>
        </span>
        <div class="page-title"><span class='beta page-title__item'>Se connecter</span></div>
        <div class="form form--popup-box">
            <?php
                echo $this->Form->create('User', array('novalidate' => true, 'url' => array('controller' => 'users', 'action' => 'login')));
                    echo $this->Form->input('username', array('label' => 'Pseudo', 'class' => 'input-text input-text--popup-box'));
                    echo $this->Form->input('password',  array('label' => 'Mot de passe', 'class' => 'input-password input-password--popup-box'));
            ?>
            <span class='popup-box__password-link'>
                <?php
                    echo $this->Html->link(
                        'Mot de passe oublié',
                        array('controller' => 'users', 'action' => 'forgottenPassword'),
                        array('title' => 'Aller à la page de mot de passe oublié', 'class' => 'link link--password')
                    );
                ?>
            </span>
            <?php echo $this->Form->end(__('Se connecter'));?>
        </div>
    </div>
</div>
