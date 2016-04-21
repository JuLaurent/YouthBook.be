<?php

    $this->assign('title', $book['Book']['title']);
    $this->assign('description', 'Fiche du livre ' . $book['Book']['title']);

?>

<?php // echo $this->element('book-nav'); ?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'><?php echo $book['Book']['title'] ?></h2></div>

    <div class='social-links'>
        <span class='user__action'><?php echo $this->SocialShare->fa('facebook', null,  array( 'title' => 'Partager via facebook')); ?></span>
        <span class='user__action'><?php echo $this->SocialShare->fa('gplus', null,  array( 'title' => 'Partager via Google +')); ?></span>
        <span class='user__action'><?php echo $this->SocialShare->fa('twitter', null,  array( 'title' => 'Partager via Twitter')); ?></span>

        <?php
            if($this->Session->check('Auth.User.id')) {
                if($inUserCollection == false) {
                    echo $this->Form->create('Book', array('novalidate' => true, 'url' => array('controller' => 'books', 'action' => 'addToCollection'), 'class' => 'user__action user__action--form'));
                            echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                            echo $this->Form->input('id', array('type' => 'hidden', 'value' => $book['Book']['id']));
                    echo $this->Form->end( array('label' => '+', 'title' => 'Ajouter à ma collection de livres', 'class' => 'user__action--input user__action--add'));
                }
                else {
                    echo $this->Form->create('Book', array('novalidate' => true, 'url' => array('controller' => 'books', 'action' => 'removeFromCollection'), 'class' => 'user__action user__action--form'));
                            echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                            echo $this->Form->input('id', array('type' => 'hidden', 'value' => $book['Book']['id']));
                    echo $this->Form->end( array('label' => '-', 'title' => 'Enlever de ma collection de livres', 'class' => 'user__action--input user__action--remove'));
                }
            }
        ?>
    </div>

    <section class='bloc'>
        <div class='bloc-title hidden'><h3>Fiche descriptive</h3></div>
        <div class='clearfix sheet'>
            <div class='sheet__cover'>
                <?php if( $book['Book']['cover'] ): ?>
                    <a href='<?php echo ('/img/covers/' . $book['Book']['id'] . '/' . $book['Book']['cover']) ?>' title='Voir la couverture du livre <?php echo $book['Book']['title'] ?> en grand format' class='image-box__link image-box__popup'>
                        <div class='sheet__image'>
                            <?php echo $this->Html->image('covers/' . $book['Book']['id'] . '/normal_' . $book['Book']['cover'], array('alt' => 'Couverture du livre ' . $book['Book']['title'], 'srcset' => $this->webroot . 'img/covers/' . $book['Book']['id'] . '/normal_' . $book['Book']['cover'] . ' 1x, ' . $this->webroot . 'img/covers/' . $book['Book']['id'] . '/normalHR_' . $book['Book']['cover'] . ' 2x', 'width' => '282', 'height' => '440')); ?>
                        </div>
                    </a>
                <?php else: ?>
                    <div class='sheet__image'>
                        <?php echo $this->Html->image('covers/noCoverSmall.png', array('alt' => 'Couverture de substitution', 'srcset' => $this->webroot . 'img/covers/normal_noCover.png 1x, ' . $this->webroot . 'img//covers/normalHR_noCover.png 2x', 'width' => '282', 'height' => '440')); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class='sheet__informations clearfix'>
                <dl class='bloc clearfix'>
                    <dt class='sheet__term'>Auteurs(s)</dt>
                    <?php if($book['Book']['author']): ?>
                        <dd class='sheet__description'><?php echo $book['Book']['author'] ?></dd>
                    <?php else: ?>
                        <dd class='sheet__description'>Inconnu</dd>
                    <?php endif; ?>
                    <dt class='sheet__term'>Nombre de pages</dt>
                    <?php if($book['Book']['pages']): ?>
                        <dd class='sheet__description'><?php echo $book['Book']['pages'] ?></dd>
                    <?php else: ?>
                        <dd class='sheet__description'>Inconnu</dd>
                    <?php endif; ?>
                    <dt class='sheet__term'>Date de sortie</dt>
                    <?php if($book['Book']['release_date']): ?>
                        <dd class='sheet__description'><?php echo $this->Time->format('d/m/Y', $book['Book']['release_date']) ?></dd>
                    <?php else: ?>
                        <dd class='sheet__description'>Inconnu</dd>
                    <?php endif; ?>
                    <dt class='sheet__term'>ISBN 10</dt>
                    <?php if($book['Book']['isbn10']): ?>
                        <dd class='sheet__description'><?php echo $book['Book']['isbn10'] ?></dd>
                    <?php else: ?>
                        <dd class='sheet__description'>Inconnu</dd>
                    <?php endif; ?>
                    <dt class='sheet__term'>ISBN 13</dt>
                    <?php if($book['Book']['isbn13']): ?>
                        <dd class='sheet__description'><?php echo $book['Book']['isbn13'] ?></dd>
                    <?php else: ?>
                        <dd class='sheet__description'>Inconnu</dd>
                    <?php endif; ?>
                    <dt class='sheet__term'>Résumé</dt>
                    <?php if($book['Book']['summary']): ?>
                        <dd class='sheet__description sheet__description--summary'><?php echo $book['Book']['summary'] ?></dd>
                    <?php else: ?>
                        <dd class='sheet__description'>Inconnu</dd>
                    <?php endif; ?>
                </dl>
                <?php if( $book['Book']['creator_id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur' ): ?>
                    <div class='buttons'>
                        <span class='button'>
                            <?php echo $this->Html->link(
                                    'Modifier la fiche',
                                    array('controller' => 'books', 'action' => 'edit', 'slug' => $book['Book']['slug']),
                                    array('title' => 'Aller à la page de modification de fiche')
                                );
                            ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </section>


        <section class='bloc bloc--padding'>
            <div class='bloc-title'><h3>Les dernières critiques</h3></div>
            <?php if($latestReviews): ?>
                <ol>
                    <?php foreach($latestReviews as $review): ?>
                        <li class='recent-article__item recent-article__item--sheet'>
                            <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $review['Article']['id'], 'slug2' => $review['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de la critique <?php echo $review['Article']['title'] ?>' class='link'>
                                <span class='recent-article recent-review recent-article--sheet'>
                                    <span class='recent-article__date recent-article__date--sheet'><?php echo $this->Time->format('j/m', $review['Article']['created']) ?></span>
                                    <span class='article-link__title'><?php echo $review['Article']['title'] ?></span>
                                    <span class='article-link__username'>par <?php echo $review['User']['username'] ?></span>
                                    <span class='recent-article__title recent-article__title--sheet'>(<?php echo $review['Article']['rating'] ?>/5)</span>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
                <div class='buttons'>
                    <span class='button'>
                        <?php echo $this->Html->link(
                                'Voir toutes les critiques',
                                array('controller' => 'books', 'action' => 'articles', 'slug1' => $book['Book']['slug'], 'slug2' => 'critiques'),
                                array('title' => 'Aller à la page des critiques du livre')
                            );
                        ?>
                    </span>
                    <span class='button'>
                        <?php
                            echo $this->Form->create('Request', array('novalidate' => true, 'url' => array('controller' => 'articles', 'action' => 'addStepOne')));
                                echo $this->Form->input('Article.Type.0', array('type' => 'hidden', 'value' => '1'));
                                echo $this->Form->input('Article.Book.0', array('type' => 'hidden', 'value' => $book['Book']['id']));
                            echo $this->Form->end(array('label' => 'Écrire une critique', 'class' => 'button--submit'));
                        ?>
                    </span>
                </div>
            <?php else: ?>
                <p class='important'>Pas encore de critique ?</p>
                <div class='buttons'>
                    <?php
                        if($requestedByUser != true && $this->Session->check('Auth.User.id')) {
                            echo $this->Form->create('Request', array('novalidate' => true, 'url' => array('controller' => 'requests', 'action' => 'add'), 'class' => 'button'));
                                echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                echo $this->Form->input('book_id', array('type' => 'hidden', 'value' => $book['Book']['id']));
                            echo $this->Form->end(array('label' => 'Faire une requête', 'class' => 'button--submit'));
                        }
                        else if($this->Session->check('Auth.User.id')) {
                            echo $this->Form->create('Request', array('novalidate' => true, 'url' => array('controller' => 'requests', 'action' => 'delete'), 'class' => 'button'));
                                echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                echo $this->Form->input('book_id', array('type' => 'hidden', 'value' => $book['Book']['id']));
                            echo $this->Form->end(array('label' => 'Annuler la requête', 'class' => 'button--submit'));
                        }
                    ?>

                    <span class='button'>
                        <?php
                            echo $this->Form->create('Request', array('novalidate' => true, 'url' => array('controller' => 'articles', 'action' => 'addStepOne')));
                                echo $this->Form->input('Article.Type.0', array('type' => 'hidden', 'value' => '1'));
                                echo $this->Form->input('Article.Book.0', array('type' => 'hidden', 'value' => $book['Book']['id']));
                            echo $this->Form->end(array('label' => 'Écrire une critique', 'class' => 'button--submit'));
                        ?>
                    </span>
                </div>
            <?php endif; ?>
        </section>

        <section class='bloc bloc--padding'>
            <div class='bloc-title'><h3>Les derniers articles</h3></div>
            <?php if($latestArticles): ?>
                <ol>
                    <?php foreach ($latestArticles as $article): ?>
                        <li class='recent-article__item recent-article__item--sheet'>
                            <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link'>
                                <span class='link article-link'>
                                    <span class='article-link__date'><?php echo $this->Time->format('d/m', $article['Article']['created']) ?></span>
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
                </ol>
                <div class='buttons'>

                    <span class='button'>
                        <?php echo $this->Html->link(
                                'Voir tous les articles',
                                array('controller' => 'books', 'action' => 'articles', 'slug1' => $book['Book']['slug'], 'slug2' => 'articles'),
                                array('title' => 'Aller à la page des articles du livre')
                            );
                        ?>
                    </span>
                    <span class='button'>
                        <?php echo $this->Html->link(
                                'Écrire un article',
                                array('controller' => 'articles', 'action' => 'addStepOne'),
                                array('title' => 'Écrire un nouvel article')
                            );
                        ?>
                    </span>
                </div>
            <?php else: ?>
                <p class='important'>Pas encore d'article ? Écrivez en un.</p>
                <div class='buttons'>
                    <span class='button'>
                        <?php
                            echo $this->Form->create('Request', array('novalidate' => true, 'url' => array('controller' => 'articles', 'action' => 'addBeforeStepOne')));
                                echo $this->Form->input('Article.Book.0', array('type' => 'hidden', 'value' => $book['Book']['id']));
                            echo $this->Form->end(array('label' => 'Écrire un article', 'class' => 'button--submit'));
                        ?>
                    </span>
                </div>
            <?php endif; ?>
        </section>


</section>
