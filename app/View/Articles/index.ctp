<?php

    $this->assign('title', ucfirst($type['Type']['name_pl']));
    $this->assign('description', 'Liste des ' . $type['Type']['name_pl']);

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Les <?php echo $type['Type']['name_pl'] ?></h2></div>

    <section class='bloc'>
        <div class='bloc-title bloc-title--padding'><h3>Les <?php echo $type['Type']['name_pl'] ?> à la une</h3></div>
        <div class='clearfix'>
            <?php foreach($lastArticles as $article): ?>
                <div class='image-box__article'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à l&apos;article <?php echo $article['Article']['title'] ?>' class='image-box__link'>
                        <div class='image-box__image'>
                            <?php
                                if( $article['Article']['thumbnail'] ) {
                                    echo $this->Html->image('articlesThumbnails/' . $article['Article']['id'] . '/small_' . $article['Article']['thumbnail'], array('alt' => 'Thumbnail de l’article' . $article['Article']['title']));
                                }
                                else {
                                    echo $this->Html->image('articlesThumbnails/noThumbnailSmall.png', array('alt' => 'Couverture de substitution'));
                                } ?>

                        </div>
                        <div class='image-box__types'>
                            <?php foreach($article['Type'] as $type): ?>
                                <span class='image-box__type image-box__type--highlighted-article'><?php echo $type['name'] ?></span>
                            <?php endforeach; ?>
                        </div>
                        <span class='image-box__information image-box__information--cover image-box__title image-box__title--cover'><?php echo $article['Article']['title'] ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <section class='bloc bloc--padding'>
        <div class='bloc-title'><h3>Tous les articles</h3></div>
        <ul>
            <?php foreach($articles as $article): ?>

                <li>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link'>
                        <span class='link article-link'>
                            <span class='article-link__date'><?php echo $this->Time->format('d/m/Y', $article['Article']['created']) ?></span>
                            <span class='article-link__types'>
                                <?php foreach($article['Type'] as $type): ?>
                                    <span class='article-link__type'><?php echo $type['name'] ?></span>
                                <?php endforeach; ?>
                            </span>
                            <span class='article-link__title'><?php echo $article['Article']['title'] ?></span>
                            <span class='article-link__username'>par <?php echo $article['User']['username'] ?></span>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <div>
        <p class='important'>Envie de rédiger un article ?</p>
        <div class='buttons'>
            <span class='button'>
                <?php echo $this->Html->link(
                        'Rédigez-le',
                        array('controller' => 'articles', 'action' => 'addStepOne'),
                        array('title' => 'Aller à la page d’ajout d’article')
                    );
                ?>
            </span>
        </div>
    </div>

</section>
