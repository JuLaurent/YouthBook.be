<?php

    $this->assign('title', 'Mes articles');
    $this->assign('description', 'Mes articles');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Mes articles</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $articles != null ): ?>
            <ul>
                <?php foreach($articles as $article): ?>
                    <li class='recent-article__item'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link'>
                            <span class='link article-link'>
                                <span class='article-link__title article-link__title--user'><?php echo $article['Article']['title'] ?></span>
                                <span class='article-link__types'>
                                    <?php foreach($article['Type'] as $type): ?>
                                        <span class='article-link__type'><?php echo $type['name'] ?></span>
                                    <?php endforeach; ?>
                                </span>
                                <span class='article-link__date article-link__date--user'>(<?php echo $this->Time->format('d/m/Y', $article['Article']['created']) ?>)</span>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez aucun article publié sur le site.</p>
        <?php endif; ?>
    </div>

</section>
