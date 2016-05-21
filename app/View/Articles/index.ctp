<?php

    $this->assign('title', ucfirst($type['Type']['name_pl']));
    $this->assign('description', 'Liste des ' . $type['Type']['name_pl']);

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Les <?php echo $type['Type']['name_pl'] ?></h2></div>

    <section class='bloc'>
        <div class='bloc-title bloc-title--padding'><h3>Les <?php echo $type['Type']['name_pl'] ?> à la une</h3></div>
        <div class='clearfix' itemtype='http://schema.org/Article'>
            <?php foreach($lastArticles as $article): ?>
                <div class='image-box__article'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à l&apos;article <?php echo $article['Article']['title'] ?>' class='image-box__link' itemprop='url'>
                        <div class='image-box__image' itemprop='image'>
                            <?php
                                if( $article['Article']['thumbnail'] ) {
                                    echo $this->Html->image('articlesThumbnails/' . $article['Article']['id'] . '/small_' . $article['Article']['thumbnail'], array('alt' => 'Thumbnail de l’article' . $article['Article']['title'], 'srcset' => $this->webroot . 'img/articlesThumbnails/' . $article['Article']['id'] . '/small_' . $article['Article']['thumbnail'] . ' 1x, ' . $this->webroot . 'img/articlesThumbnails/' . $article['Article']['id'] . '/smallHR_' . $article['Article']['thumbnail'] . ' 2x', 'width' => '282', 'height' => '175'));
                                }
                                else {
                                    echo $this->Html->image('articlesThumbnails/noThumbnailSmall.png', array('alt' => 'Couverture de substitution', 'srcset' => $this->webroot . 'img/articlesThumbnails/small_noThumbnail.png 1x, ' . $this->webroot . 'img/articlesThumbnails/smallHR_noThumbnail.png 2x', 'width' => '282', 'height' => '175'));
                                } ?>

                        </div>
                        <div class='image-box__types'>
                            <?php foreach($article['Type'] as $type): ?>
                                <span class='image-box__type image-box__type--highlighted-article'><?php echo $type['name'] ?></span>
                            <?php endforeach; ?>
                        </div>
                        <span class='image-box__information image-box__information--cover image-box__title image-box__title--cover' itemprop='name'><?php echo $article['Article']['title'] ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <section class='bloc bloc--padding'>
        <div class='bloc-title'><h3>Tous les articles</h3></div>
        <ul itemscope itemtype='https://schema.org/ItemList'>
            <?php foreach($articles as $article): ?>
                <li itemprop='itemListElement' itemscope itemtype='http://schema.org/Article'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link' itemprop='url'>
                        <div class='recent-article recent-article--sheet'>
                            <div class='recent-article__title recent-article__title--sheet' itemprop='name'><?php echo $article['Article']['title'] ?></div>
                            <div class='recent-article__informations recent-article__informations--sheet clearfix'>
                                <span class='recent-article__date' itemprop='datePublished'><?php echo $this->Time->format('d/m', $article['Article']['created']) ?></span>
                                <span class='recent-article__types'>
                                    <?php foreach($article['Type'] as $type): ?>
                                        <span class='recent-article__type'><?php echo $type['name'] ?></span>
                                    <?php endforeach; ?>
                                </span>
                                <span class='recent-article__author' itemprop='author'><?php echo $article['User']['username'] ?></span>
                            </div>
                        </div>
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
