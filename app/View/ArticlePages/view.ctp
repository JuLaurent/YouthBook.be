<?php

    $this->assign('title', $articlePage['Article']['title'] );
    $this->assign('description', $articlePage['Article']['title']);

?>

<section class='bloc bloc--padding'>

    <div class='page-title'><h2 class='beta page-title__item'><?php echo $articlePage['Article']['title'] ?></h2></div>

    <div class='social-links'>
        <span class='user__action'><?php echo $this->SocialShare->fa('facebook', null,  array( 'title' => 'Partager via facebook')); ?></span>
        <span class='user__action'><?php echo $this->SocialShare->fa('gplus', null,  array( 'title' => 'Partager via Google +')); ?></span>
        <span class='user__action'><?php echo $this->SocialShare->fa('twitter', null,  array( 'title' => 'Partager via Twitter')); ?></span>
    </div>
    <div class='clearfix'>
        <div class='article__content'>

            <?php if( $articlePage['Article']['number_of_pages'] > 1 ): ?>
                <div class='pagination'>
                    <?php for($i = 1 ; $i <= $articlePage['Article']['number_of_pages'] ; $i++): ?>
                        <span class='pagination__character character'>
                            <a  href='<?php echo($this->Html->url( array('controller' => 'articlePages', 'action' => 'view', 'slug1' => $articlePage['Article']['id'], 'slug2' => $articlePage['Article']['slug'], 'slug3' => $i))) ?>' title='Aller à la page <?php echo($i) ?>' class='<?php if($this->params['pass'][2] == $i) echo('character__active ') ?>character__link'><?php echo($i) ?></a>
                        </span>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <?php if( $articlePage['ArticlePage']['page_number'] == 1 ): ?>
                <div class='article__user message'>
                    <span class='user__avatar user__avatar--article article__avatar'>
                          <?php
                              if($articlePage['Article']['User']['avatar']) {
                                  echo $this->Html->image('avatars/' . $articlePage['Article']['User']['id'] . '/small_' . $articlePage['Article']['User']['avatar'], array('alt' => 'Votre avatar', 'srcset' => $this->webroot . 'img/avatars/' . $articlePage['Article']['User']['id'] . '/small_' . $articlePage['Article']['User']['avatar'] . ' 1x, ' . $this->webroot . 'img/avatars/' . $articlePage['Article']['User']['id'] . '/smallHR_' . $articlePage['Article']['User']['avatar'] . ' 2x', 'width' => '48', 'height' => '48'));
                              }
                              else {
                                  echo $this->Html->image('avatars/small_noAvatar.png', array('alt' => 'Avatar de substitution', 'srcset' => $this->webroot . 'img/avatars/small_noAvatar.png 1x, ' . $this->webroot . 'img/avatars/smallHR_noAvatar.png 2x', 'width' => '48', 'height' => '48'));
                              }
                          ?>
                    </span>
                    <span class='article__username'>
                        Publiée par <?php echo $articlePage['Article']['User']['username'] ?> le <?php echo $this->Time->format('d/m/Y', $articlePage['Article']['created']) ?>
                    </span>
                </div>
            <?php endif; ?>

            <div class='article__text clearfix'><?php echo $articlePage['ArticlePage']['content'] ?></div>

            <?php foreach( $articlePage['Article']['Type'] as $type ): ?>
                <?php if( $type['slug'] == 'critiques' && $articlePage['Article']['number_of_pages'] == $articlePage['ArticlePage']['page_number']): ?>
                    <div class='article__rating rating__container'>
                        <span class='rating__content rating__content-1'>Appréciation finale</span>
                        <div class='rating__content rating__content-2'>
                            <?php for($i = 0 ; $i < intval($articlePage['Article']['rating']) ; $i++): ?>
                                <span class='rating__1'>●</span>
                            <?php endfor; ?>
                            <?php for($i = 5 ; $i > intval($articlePage['Article']['rating']) ; $i--): ?>
                                <span class='rating__2'>●</span>
                            <?php endfor; ?>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>

            <?php if( $articlePage['Article']['number_of_pages'] > 1 ): ?>
                <div class='pagination'>
                    <?php for($i = 1 ; $i <= $articlePage['Article']['number_of_pages'] ; $i++): ?>
                        <span class='pagination__character character'>
                            <a  href='<?php echo($this->Html->url( array('controller' => 'articlePages', 'action' => 'view', 'slug1' => $articlePage['Article']['id'], 'slug2' => $articlePage['Article']['slug'], 'slug3' => $i))) ?>' title='Aller à la page <?php echo($i) ?>' class='<?php if($this->params['pass'][2] == $i) echo('character__active ') ?>character__link'><?php echo($i) ?></a>
                        </span>
                      <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class='article__side side'>
            <?php if($articlePage['Article']['draft'] == 1 && ($articlePage['Article']['User']['id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur')): ?>
                <div class='article__actions'>
                    <div class='side__action'>
                        <?php echo $this->Form->create('Article', array('url' => array('controller' => 'articles', 'action' => 'post'), 'class' => 'side__form')); ?>
                            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $articlePage['Article']['id'])); ?>
                            <?php echo $this->Form->input('draft', array('type' => 'hidden', 'value' => 0)); ?>
                        <?php echo $this->Form->end(__('Publier l’article')); ?>
                    </div>
                    <span class='side__action recent-articles__button'>
                        <?php echo $this->Html->link(
                                'Modifier le brouillon',
                                array('controller' => 'articles', 'action' => 'edit', 'slug1' => $articlePage['Article']['id'], 'slug2' => $articlePage['Article']['slug']),
                                array('title' => 'Aller à la page de modification de l’article')
                            );
                        ?>
                    </span>
                    <div class='side__action'>
                        <?php echo $this->Form->create('Article', array('url' => array('controller' => 'articles', 'action' => 'delete'), 'onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce brouillon ?");', 'class' => 'side__form')); ?>
                            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $articlePage['Article']['id'])); ?>
                        <?php echo $this->Form->end(array('label' => 'Supprimer l’article', 'class' => 'button--submit')); ?>
                    </div>
                </div>
            <?php elseif($articlePage['Article']['draft'] == 0 && ($articlePage['Article']['User']['id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'moderateur')): ?>
                <div class='article__actions'>
                    <span class='side__action recent-articles__button'>
                        <?php echo $this->Html->link(
                                'Modifier l’article',
                                array('controller' => 'articles', 'action' => 'edit', 'slug1' => $articlePage['Article']['id'], 'slug2' => $articlePage['Article']['slug']),
                                array('title' => 'Aller à la page de modification de l’article')
                            );
                        ?>
                    </span>
                    <div class='side__action'>
                        <?php echo $this->Form->create('Article', array('url' => array('controller' => 'articles', 'action' => 'delete'), 'onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce brouillon ?");', 'class' => 'side__form')); ?>
                            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $articlePage['Article']['id'])); ?>
                        <?php echo $this->Form->end(array('label' => 'Supprimer l’article', 'class' => 'button--submit')); ?>
                    </div>
                </div>
            <?php endif; ?>
            <section>
                <div class='bloc-title'><h3 class='delta'>Les livres évoqués</h3></div>
                <ol>
                    <?php foreach($articlePage['Article']['Book'] as $book): ?>
                        <li class='recent-article__item'>
                            <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['slug'] )) ?>' class='link'>
                                <?php echo $book['title'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </section>
        </div>
    </div>

</section>
