<?php

    $this->assign('title', 'Page d’accueil');
    $this->assign('description', 'Site d’actualités littéraires communautaire');

?>

<section>

    <div class='page-title hidden'><h2>Page d’accueil</h2></div>

    <section class='section clearfix'>

        <div class='section-title hidden'><h3>Les critiques</h3></div>

        <section class='image-box image-box--highlighted-review'>
            <div class='bloc-title hidden'><h4>Critique à la une</h3></div>

            <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $highlightedReview['Article']['id'], 'slug2' => $highlightedReview['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de la critique <?php echo $highlightedReview['Article']['title'] ?>' class='image-box__link'>
                <div class='image-box__image image-box__image--highlighted-review'>
                    <?php
                        if( $highlightedReview['Article']['thumbnail'] ) {
                            echo $this->Html->image('articlesThumbnails/' . $highlightedReview['Article']['id'] . '/big_' . $highlightedReview['Article']['thumbnail'], array('alt' => 'Thumbnail de l’article' . $highlightedReview['Article']['title'], 'srcset' => $this->webroot . 'img/articlesThumbnails/' . $highlightedReview['Article']['id'] . '/big_' . $highlightedReview['Article']['thumbnail'] . ' 1x, ' . $this->webroot . 'img/articlesThumbnails/' . $highlightedReview['Article']['id'] . '/bigHR_' . $highlightedReview['Article']['thumbnail'] . ' 2x', 'width' => '750', 'height' => '404'));
                        }
                        else {
                            echo $this->Html->image('articlesThumbnails/big_noThumbnail.png', array('alt' => 'Couverture de substitution', 'srcset' => $this->webroot . 'img/articlesThumbnails/big_noThumbnail.png 1x, ' . $this->webroot . 'img/articlesThumbnails/bigHR_noThumbnail.png 2x', 'width' => '750', 'height' => '350'));
                        }
                    ?>
                </div>
                <div class='image-box__types'>
                    <?php foreach($highlightedReview['Type'] as $type): ?>
                        <span class='image-box__type image-box__type--highlighted-review'><?php echo $type['name'] ?></span>
                    <?php endforeach; ?>
                </div>
                <span class='image-box__information image-box__information--highlighted-review image-box__title image-box__title--highlighted-review'><?php echo $highlightedReview['Article']['title'] ?> <span class='image-box__author--highlighted-review'>par <?php echo $highlightedReview['User']['username'] ?></span></span>
            </a>
        </section>

        <section class='recent-articles recent-reviews'>
            <div class='bloc-title'><h4>Les dernières critiques</h4></div>
            <ol>
                <?php foreach($recentReviews as $review): ?>

                    <li class='recent-article__item'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $review['Article']['id'], 'slug2' => $review['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de la critique <?php echo $review['Article']['title'] ?>' class='link'>
                            <div class='recent-article'>
                                <div class='recent-article__title'><?php echo $review['Article']['title'] ?></div>
                                <div class='recent-article__informations clearfix'>
                                    <span class='recent-article__date'><?php echo $this->Time->format('d/m', $review['Article']['created']) ?></span>
                                    <span class='recent-article__author'><?php echo $review['User']['username'] ?></span>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
            <span class='recent-articles__button'>
                <?php echo $this->Html->link(
                        'Toutes les critiques',
                        array('controller' => 'articles', 'action' => 'index', 'slug' => 'critiques'),
                        array('title' => 'Aller à la page des critiques')
                    );
                ?>
            </span>
        </section>

    </section>

    <section class='section clearfix'>

        <div class='section-title hidden'><h3>Les news</h3></div>

        <section class='image-box image-box--highlighted-articles clearfix'>

            <div class='bloc-title hidden'><h4>Articles à la une</h3></div>

            <?php foreach ($highlightedArticles as $article): ?>

                <div class='image-box__highlighted-article'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='image-box__link'>
                      <div class='image-box__image image-box__image--highlighted-article'>
                          <?php
                              if( $article['Article']['thumbnail'] ) {
                                  echo $this->Html->image('articlesThumbnails/' . $article['Article']['id'] . '/normal_' . $article['Article']['thumbnail'], array('alt' => 'Thumbnail de l’article' . $article['Article']['title'], 'srcset' => $this->webroot . 'img/articlesThumbnails/' . $article['Article']['id'] . '/normal_' . $article['Article']['thumbnail'] . ' 1x, ' . $this->webroot . 'img/articlesThumbnails/' . $article['Article']['id'] . '/normalHR_' . $article['Article']['thumbnail'] . ' 2x', 'width' => '360', 'height' => '188'));
                              }
                              else {
                                  echo $this->Html->image('articlesThumbnails/normal_noThumbnail.png', array('alt' => 'Couverture de substitution', 'srcset' => $this->webroot . 'img/articlesThumbnails/normal_noThumbnail.png 1x, ' . $this->webroot . 'img/articlesThumbnails/normalHR_noThumbnail.png 2x', 'width' => '360', 'height' => '188'));
                              } ?>

                      </div>
                        <div class='image-box__types'>
                            <?php foreach($article['Type'] as $type): ?>
                                <span class='image-box__type image-box__type--highlighted-article'><?php echo $type['name'] ?></span>
                            <?php endforeach; ?>
                        </div>
                        <span class='image-box__information image-box__information--highlighted-article image-box__title image-box__title--highlighted-article'><?php echo $article['Article']['title'] ?> <span class='image-box__author--highlighted-article'>par <?php echo $article['User']['username'] ?></span></span>
                    </a>
                </div>

            <?php endforeach; ?>

        </section>

        <section class='recent-articles'>
            <div class='bloc-title'><h4>Les derniers articles</h4></div>
            <ol>
                <?php foreach ($recentArticles as $article): ?>
                    <li class='recent-article__item'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l’article <?php echo $article['Article']['title'] ?>' class='link'>
                            <div class='recent-article'>
                                <div class='recent-article__title'><?php echo $article['Article']['title'] ?></div>
                                <div class='recent-article__informations clearfix'>
                                    <span class='recent-article__date'><?php echo $this->Time->format('d/m', $article['Article']['created']) ?></span>
                                    <span class='recent-article__types'>
                                        <?php foreach($article['Type'] as $type): ?>
                                            <span class='recent-article__type'><?php echo $type['name'] ?></span>
                                        <?php endforeach; ?>
                                    </span>
                                    <span class='recent-article__author'><?php echo $article['User']['username'] ?></span>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
            <div class='recent-articles__buttons'>
                <span class='recent-articles__button'>
                    <?php echo $this->Html->link(
                            'Tous les articles',
                            array('controller' => 'articles', 'action' => 'index', 'slug' => 'news'),
                            array('title' => 'Aller à la page des news')
                        );
                    ?>
                </span>
                <span class='recent-articles__button'>
                    <?php echo $this->Html->link(
                            'Tous les dossiers',
                            array('controller' => 'articles', 'action' => 'index', 'slug' => 'dossiers'),
                            array('title' => 'Aller à la page des dossiers')
                        );
                    ?>
                </span>
                <span class='recent-articles__button'>
                    <?php echo $this->Html->link(
                            'Tous les produits dérivés',
                            array('controller' => 'articles', 'action' => 'index', 'slug' => 'produits_derives'),
                            array('title' => 'Aller à la page des produits dérivés')
                        );
                    ?>
                </span>
            </div>
        </section>

    </section>

    <section class='section clearfix'>

        <div class='bloc-title bloc-title--padding'><h3>Les derniers livres parus</h3></div>

        <div class='clearfix'>
            <?php foreach($recentBooks as $book): ?>
                <div class='image-box__cover'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' title='Aller à la fiche du livre <?php echo $book['Book']['title'] ?>' class='image-box__link'>
                        <div class='image-box__image image-box__image--cover'>
                            <?php
                                if( $book['Book']['cover'] ) {
                                    echo $this->Html->image('covers/' . $book['Book']['id'] . '/small_' . $book['Book']['cover'], array('alt' => 'Couverture du livre ' . $book['Book']['title'], 'srcset' => $this->webroot . 'img/covers/' . $book['Book']['id'] . '/small_' . $book['Book']['cover'] . ' 1x, ' . $this->webroot . 'img/covers/' . $book['Book']['id'] . '/smallHR_' . $book['Book']['cover'] . ' 2x', 'width' => '126', 'height' => '200'));
                                }
                                else {
                                    echo $this->Html->image('covers/noCoverSmall.png', array('alt' => 'Couverture de substitution', 'srcset' => $this->webroot . 'img/covers/small_noCover.png 1x, ' . $this->webroot . 'img//covers/smallHR_noCover.png 2x', 'width' => '126', 'height' => '200'));
                                } ?>

                        </div>
                        <span class='image-box__information image-box__information--cover image-box__date image-box__date--cover'><?php echo $this->Time->format('d/m/Y', $book['Book']['release_date']) ?></span>
                        <span class='image-box__information image-box__information--cover image-box__title image-box__title--cover'><?php echo $book['Book']['title'] ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </section>

</section>
