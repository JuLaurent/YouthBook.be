<nav class='left-nav'>
    <div class='hidden'><h2>Menu de navigation utilisateur</h2></div>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'collection') ) ?>' title='Aller à la page de ma collection de livres' class='<?php if($this->params['controller'] == 'users' && $this->params['action'] == 'collection') echo 'nav__active ' ?>left-nav__item'>Ma collection</a>
    </span>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'subscriptions') ) ?>' title='Aller à la page de mes abonnements' class='<?php if($this->params['controller'] == 'users' && $this->params['action'] == 'subscriptions') echo 'nav__active ' ?>left-nav__item'>Mes abonnements</a>
    </span>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'books') ) ?>' title='Aller à la page de mes fiches de livres' class='<?php if($this->params['controller'] == 'users' && $this->params['action'] == 'books') echo 'nav__active ' ?>left-nav__item'>Mes fiches de livres</a>
    </span>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'sagas') ) ?>' title='Aller à la page de mes fiches de sagas' class='<?php if($this->params['controller'] == 'users' && $this->params['action'] == 'sagas') echo 'nav__active ' ?>left-nav__item'>Mes fiches de sagas</a>
    </span>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'articles') ) ?>' title='Aller à la page des articles' class='<?php if($this->params['controller'] == 'users' && $this->params['action'] == 'articles') echo 'nav__active ' ?>left-nav__item'>Mes articles</a>
    </span>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'drafts') ) ?>' title='Aller à la page des brouillons' class='<?php if($this->params['controller'] == 'users' && $this->params['action'] == 'drafts') echo 'nav__active ' ?>left-nav__item'>Mes brouillons</a>
    </span>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'editInformations') ) ?>' title='Aller à la page de modification des informations du compte' class='<?php if($this->params['controller'] == 'users' && $this->params['action'] == 'editInformations') echo 'nav__active ' ?>left-nav__item'>Modifier mes informations</a>
    </span>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'editPassword') ) ?>' title='Aller à la page de modication du mot de passe du compte' class='<?php if($this->params['controller'] == 'users' && $this->params['action'] == 'editPassword') echo 'nav__active ' ?>left-nav__item'>Modifier mon mot de passe</a>
    </span>
</nav>
