<?php

    $this->assign('title', 'Mes fiches');
    $this->assign('description', 'Liste de mes fiches de livres');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Mes fiches de livre</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $books != null ): ?>
            <ul>
                <?php foreach($books as $book): ?>
                    <li class='recent-article recent-article--book'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link'>
                            <?php echo $book['Book']['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez créé aucune fiche de livre.</p>
        <?php endif; ?>
    </div>

</section>
