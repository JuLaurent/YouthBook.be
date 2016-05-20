<div class="nav">
    <nav>
        <div class="nav__title hidden">
            <h2>Menu de navigation Header</h2>
        </div>
        <div class="nav__items clearfix">
            <span class="nav__item-container">
                <a  href='<?php echo $this->Html->url( array('controller' => 'dynamicPages', 'action' => 'home') ) ?>' title='Aller à la page d’accueil' class='<?php if($this->params['controller'] == 'dynamicPages' && $this->params['action'] == 'home') echo 'nav__active ' ?>nav__item'>Accueil</a>
            </span>
            <span class="nav__item-container">
                <a  href='<?php echo $this->Html->url( array('controller' => 'articles', 'action' => 'index', 'slug' => 'critiques') ) ?>' title='Aller à la page des critiques' class='<?php if($this->params['controller'] == 'articles' && $this->params['action'] == 'index' && $this->params['pass'][0] == 'critiques') echo 'nav__active ' ?>nav__item'>Critiques</a>
            </span>
            <span class="nav__item-container">
                <a  href='<?php echo $this->Html->url( array('controller' => 'articles', 'action' => 'index', 'slug' => 'news') ) ?>' title='Aller à la page des news' class='<?php if($this->params['controller'] == 'articles' && $this->params['action'] == 'index' && $this->params['pass'][0] == 'news') echo 'nav__active ' ?>nav__item'>News</a>
            </span>
            <span class="nav__item-container">
                <a  href='<?php echo $this->Html->url( array('controller' => 'articles', 'action' => 'index', 'slug' => 'dossiers') ) ?>' title='Aller à la page des dossiers' class='<?php if($this->params['controller'] == 'articles' && $this->params['action'] == 'index' && $this->params['pass'][0] == 'dossiers') echo 'nav__active ' ?>nav__item'>Dossiers</a>
            </span>
            <span class="nav__item-container">
                <a  href='<?php echo $this->Html->url( array('controller' => 'articles', 'action' => 'index', 'slug' => 'produits_derives') ) ?>' title='Aller à la page des produits dérivés' class='<?php if($this->params['controller'] == 'articles' && $this->params['action'] == 'index' && $this->params['pass'][0] == 'produits_derives') echo 'nav__active ' ?>nav__item'>Produits dérivés</a>
            </span>
            <span class="nav__item-container">
                <a  href='<?php echo $this->Html->url( array('controller' => 'books', 'action' => 'index', 'slug' => '0-9') ) ?>' title='Aller à la page des livres' class='<?php if($this->params['controller'] == 'books' && $this->params['action'] == 'index') echo 'nav__active ' ?>nav__item'>Livres</a>
            </span>
        </div>
    </nav>
</div>
