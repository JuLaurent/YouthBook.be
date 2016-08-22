<?php

    $this->assign('title', 'Mes fiches sagas');
    $this->assign('description', 'Liste de mes fiches de sagas');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Mes fiches de sagas</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $sagas != null ): ?>
            <ul itemscope itemtype='https://schema.org/ItemList'>
                <?php foreach($sagas as $saga): ?>
                    <li class='recent-article recent-article--book' itemprop='itemListElement' itemscope itemtype='https://schema.org/Book'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'sagas', 'action'=>'view', 'slug' => $saga['Saga']['slug'] )) ?>' title="Aller à la fiche de la saga <?php echo $saga['Saga']['title'] ?>" class='link' itemprop='url'>
                            <span itemprop='name'><?php echo $saga['Saga']['title'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n’avez créé aucune fiche de saga.</p>
        <?php endif; ?>
    </div>

</section>
