<?php

    $this->assign('title', 'Mes fiches livres');
    $this->assign('description', 'Liste de mes fiches de livres');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Mes fiches de livres</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $books != null ): ?>
            <ul itemscope itemtype='https://schema.org/ItemList'>
                <?php foreach($books as $book): ?>
                    <li class='recent-article recent-article--book' itemprop='itemListElement' itemscope itemtype='https://schema.org/Book'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' title="Aller à la fiche du livre <?php echo $book['Book']['title'] ?>" class='link' itemprop='url'>
                            <span itemprop='name'><?php echo $book['Book']['title'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n’avez créé aucune fiche de livre.</p>
        <?php endif; ?>
    </div>

</section>
