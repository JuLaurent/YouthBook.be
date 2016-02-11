<nav class='left-nav'>
    <div class='hidden'><h2>Menu de navigation livre</h2></div>
    <span class='left-nav__container'>
        <?php echo $this->Html->link(
                'Fiche',
                array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']),
                array('title' => 'Aller à la fiche du livre ' . $book['Book']['title'], 'class' => 'left-nav__item')
            );
        ?>
    </span>
    <?php if($critique): ?>
        <span class='left-nav__container'>
            <?php echo $this->Html->link(
                    'Critiques',
                    array('controller' => 'users', 'action' => 'editPassword'),
                    array('title' => 'Aller à la page du mot de passe du compte', 'class' => 'left-nav__item')
                );
            ?>
        </span>
    <?php endif; ?>
    <?php if($news): ?>
        <span class='left-nav__container'>
            <?php echo $this->Html->link(
                    'News',
                    array('controller' => 'users', 'action' => 'editPassword'),
                    array('title' => 'Aller à la page du mot de passe du compte', 'class' => 'left-nav__item')
                );
            ?>
        </span>
    <?php endif; ?>
    <?php if($dossier): ?>
        <span class='left-nav__container'>
            <?php echo $this->Html->link(
                    'Dossiers',
                    array('controller' => 'users', 'action' => 'editPassword'),
                    array('title' => 'Aller à la page du mot de passe du compte', 'class' => 'left-nav__item')
                );
            ?>
        </span>
    <?php endif; ?>
    <?php if($produit_derive): ?>
        <span class='left-nav__container'>
            <?php echo $this->Html->link(
                    'Produits dérivés',
                    array('controller' => 'users', 'action' => 'editPassword'),
                    array('title' => 'Aller à la page du mot de passe du compte', 'class' => 'left-nav__item')
                );
            ?>
        </span>
    <?php endif; ?>
</nav>
