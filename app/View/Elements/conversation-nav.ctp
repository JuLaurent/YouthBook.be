<nav class='left-nav'>
    <div class='hidden'><h2>Menu de navigation conversations</h2></div>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'conversations', 'action' => 'index') ) ?>' title='Aller à la page de mes conversations' class='<?php if($this->params['controller'] == 'conversations' && $this->params['action'] == 'index') echo 'nav__active ' ?>left-nav__item'>Mes conversations</a>
    </span>
    <span class='left-nav__container'>
        <a  href='<?php echo $this->Html->url( array('controller' => 'conversations', 'action' => 'add') ) ?>' title='Aller à la page de création d’une nouvelle conversation' class='<?php if($this->params['controller'] == 'conversations' && $this->params['action'] == 'add') echo 'nav__active ' ?>left-nav__item'>Nouvelle conversation</a>
    </span>
</nav>
