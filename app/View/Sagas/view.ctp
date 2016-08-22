<?php

    $this->assign('title', $saga['Saga']['title']);
    $this->assign('description', 'La saga ' . $saga['Saga']['title']);

?>

<section itemscope itemtype='https://schema.org/Series'>

    <div class='page-title' itemprop='name'><h2 class='beta page-title__item'><?php echo $saga['Saga']['title'] ?></h2></div>

    <div class='bloc bloc--padding'>
        <div class='clearfix'>
            <div class='article__user article__user--sheet message'>
                <span class='user__avatar user__avatar--article article__avatar'>
                      <?php
                          if( $saga['User']['avatar'] ) {
                              echo $this->Html->image('avatars/' . $saga['User']['id'] . '/small_' . $saga['User']['avatar'], array('alt' => 'Votre avatar', 'srcset' => $this->webroot . 'img/avatars/' . $saga['User']['id'] . '/small_' . $saga['User']['avatar'] . ' 1x, ' . $this->webroot . 'img/avatars/' . $saga['User']['id'] . '/smallHR_' . $saga['User']['avatar'] . ' 2x', 'width' => '48', 'height' => '48'));
                          }
                          else {
                              echo $this->Html->image('avatars/small_noAvatar.png', array('alt' => 'Avatar de substitution', 'srcset' => $this->webroot . 'img/avatars/small_noAvatar.png 1x, ' . $this->webroot . 'img/avatars/smallHR_noAvatar.png 2x', 'width' => '48', 'height' => '48'));
                          }
                      ?>
                </span>
                <span class='article__username'>
                    Fiche créée par <?php echo $saga['User']['username'] ?> le <?php echo $this->Time->format('d/m/Y', $saga['Saga']['created']) ?>
                </span>
            </div>
            <div class='sheet__collection'>
                <?php
                    if($this->Session->check('Auth.User.id')) {
                        if ( empty($subscription) ) {
                            echo $this->Form->create('Subscription', array('novalidate' => true, 'url' => array('controller' => 'subscriptions', 'action' => 'subscribe'), 'class' => 'button ajax__subscription'));
                                echo $this->Form->input('Subscription.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'), 'class' => 'ajax__subscription--user-id'));
                                echo $this->Form->input('Subscription.saga_id', array('type' => 'hidden', 'value' => $saga['Saga']['id'], 'class' => 'ajax__subscription--saga-id'));
                            echo $this->Form->end( array('label' => 'S’abonner', 'class' => 'button--submit'));
                        }
                        else {
                            echo $this->Form->create('Subscription', array('novalidate' => true, 'url' => array('controller' => 'subscriptions', 'action' => 'unsubscribe'), 'class' => 'button ajax__subscription'));
                                echo $this->Form->input('Subscription.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'), 'class' => 'ajax__subscription--user-id'));
                                echo $this->Form->input('Subscription.saga_id', array('type' => 'hidden', 'value' => $saga['Saga']['id'], 'class' => 'ajax__subscription--saga-id'));
                            echo $this->Form->end( array('label' => 'Se désabonner', 'class' => 'button--submit'));
                        }
                    }
                ?>
            </div>
        </div>

        <?php if( !empty( $main ) ): ?>
            <section class='bloc'>
                <div class='bloc-title'><h3>La série principale</h3></div>
                <ul itemscope itemtype='https://schema.org/ItemList'>
                    <?php foreach($main as $book): ?>
                        <li class='recent-article recent-article--book' itemprop='itemListElement' itemscope itemtype='https://schema.org/Book'>
                            <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' title="Aller à la fiche du livre <?php echo $book['Book']['title'] ?>" class='link' itemprop='url'>
                                <span itemprop='name'><?php echo $book['Book']['title'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </section>
        <?php endif; ?>

        <?php if( !empty( $spinoff ) ): ?>
            <section class='bloc'>
                <div class='bloc-title'><h3>Les spin-off</h3></div>
                <ul itemscope itemtype='https://schema.org/ItemList'>
                    <?php foreach($spinoff as $book): ?>
                        <li class='recent-article recent-article--book' itemprop='itemListElement' itemscope itemtype='https://schema.org/Book'>
                            <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' title="Aller à la fiche du livre <?php echo $book['Book']['title'] ?>" class='link' itemprop='url'>
                                <span itemprop='name'><?php echo $book['Book']['title'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </section>
        <?php endif; ?>

        <?php if( empty( $main ) && empty( $spinoff ) ): ?>
            <p>Aucun livre n’a encore été ajouté à cette saga</p>
        <?php endif; ?>

        <?php if( $saga['Saga']['user_id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur' ): ?>
            <div>
                <div class='buttons'>
                    <span class='button'>
                        <?php echo $this->Html->link(
                                'Modifier la saga',
                                array('controller' => 'sagas', 'action' => 'edit', 'slug' => $saga['Saga']['slug']),
                                array('title' => 'Aller à la page de modification de la saga')
                            );
                        ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>

        <section class='bloc'>
            <div class='bloc-title'><h3>Les articles</h3></div>
            <?php if( !empty( $articles ) ): ?>
                <ul itemscope itemtype='https://schema.org/ItemList'>
                    <?php foreach($articles as $article): ?>
                        <li itemprop='itemListElement' itemscope itemtype='http://schema.org/Article'>
                            <div class='recent-article recent-article--sheet'>
                                <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link' itemprop='url'>
                                    <span class='recent-article__title recent-article__title--sheet' itemprop='name'><?php echo $article['Article']['title'] ?></span>
                                    <div class='recent-article__informations recent-article__informations--sheet clearfix'>
                                        <span class='recent-article__date' itemprop='datePublished'><?php echo $this->Time->format('d/m', $article['Article']['created']) ?></span>
                                        <span class='recent-article__types'>
                                            <?php foreach($article['Type'] as $type): ?>
                                                <span class='recent-article__type'><?php echo $type['name'] ?></span>
                                            <?php endforeach; ?>
                                        </span>
                                        <span class='recent-article__author' itemprop='author'><?php echo $article['User']['username'] ?></span>
                                    </div>
                                </a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun article en rapport avec cette saga n’a encore été publié.</p>
            <?php endif; ?>

        </section>



    </div>

</section>
