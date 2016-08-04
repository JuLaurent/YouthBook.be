<header class="header">
    <span class='header__menu menu menu--nav'>
        <a href='#' title='Menu de navigation' class='menu__link'><span class='fa fa-bars' aria-hidden='true' class='menu__icon'></span></a>
    </span>
    <span class='header__menu header__menu--user menu menu--user'>
        <a href='#' title='Menu utilisateur' class='menu__link'><span class='fa fa-user' aria-hidden='true' class='menu__icon'></span></a>
    </span>
    <div class="header__top">
        <div class="header__container clearfix">
            <div class="header__logo">
                <?php
                    echo $this->Html->link(
                        $this->Html->image('icons/logoV1.1.2.svg', array('alt' => 'Logo YouthBook.be', 'width' => '438', 'height' => '73')),
                        '/',
                        array('title' => 'Aller à la page d’accueil', 'escape' => false)
                    );
                ?>
            </div>
            <div class="header__user user">
                <?php echo $this->element('user'); ?>
            </div>
        </div>
    </div>
    <div class="header__bottom bottom">
        <div class="header__container bottom__container clearfix">
            <div class="header__nav">
                <?php echo $this->element('nav'); ?>
            </div>
            <div class="header__search search">
                <?php echo $this->Form->create('Book', array('type' => 'get', 'url' => array('controller' => 'dynamicPages', 'action' => 'search'), 'class' => 'search__form')); ?>
                    <?php echo $this->Form->input('search', array('type' => 'search', 'label' => 'Recherche', 'placeholder'=>'Rechercher un livre, un article', 'list' => 'books', 'class' => 'search__text ajax__datalist--search')); ?>
                    <datalist id='books' class='ajax__datalist--list'></datalist>
                <?php echo $this->Form->end(__('Rechercher')); ?>
            </div>
        </div>
    </div>
</header>
