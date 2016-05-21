<?php

    $this->assign('title', 'Mes brouillons');
    $this->assign('description', 'Mes brouillons');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Mes brouillons</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $drafts != null ): ?>
            <ul itemscope itemtype='https://schema.org/ItemList'>
                <?php foreach($drafts as $draft): ?>
                    <li class='recent-article__item' itemprop='itemListElement' itemscope itemtype='https://schema.org/Article'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $draft['Article']['id'], 'slug2' => $draft['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $draft['Article']['title'] ?>' class='link' itemprop='url'>
                            <div class='recent-article recent-article--sheet'>
                                <div class='recent-article__title recent-article__title--sheet' itemprop='name'><?php echo $draft['Article']['title'] ?></div>
                                <div class='recent-article__informations recent-article__informations--sheet clearfix'>
                                    <span class='recent-article__date' itemprop='datePublished'><?php echo $this->Time->format('d/m/Y', $draft['Article']['created']) ?></span>
                                    <span class='recent-article__types'>
                                        <?php foreach($draft['Type'] as $type): ?>
                                            <span class='recent-article__type'><?php echo $type['name'] ?></span>
                                        <?php endforeach; ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez aucun brouillon en ce moment.</p>
        <?php endif; ?>

    </div>

</section>
