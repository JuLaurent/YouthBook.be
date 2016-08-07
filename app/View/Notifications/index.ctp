<?php

    $this->assign('title', 'Notifications');
    $this->assign('description', 'Liste de mes notifications');

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Mes notifications</h2></div>

    <?php if ( $this->Session->read('Auth.User.role') == 'administrateur' ): ?>

        <?php if ( !empty( $notSeenArticles ) ): ?>
            <div class='bloc bloc--padding'>
                <ul itemscope itemtype='http://schema.org/ItemList'>
                    <?php foreach($articles as $article): ?>
                        <li itemprop='itemListElement' itemscope itemtype='https://schema.org/Article'>
                            <div class='recent-article recent-article--sheet'>
                                <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link' itemprop='url'>
                                    <span class='recent-article__title recent-article__title--sheet' itemprop='name'><?php echo $article['Article']['title'] ?></span>
                                    <div class='recent-article__informations recent-article__informations--sheet clearfix'>
                                        <span class='recent-article__date' itemprop='datePublished'><?php echo $this->Time->format('d/m', $article['Article']['created']) ?></span>
                                        <span class='recent-article__types'>
                                            <?php foreach($article['Article']['Type'] as $type): ?>
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
            </div>
        <?php else: ?>
            <p>Vous n’avez aucune notification pour le moment.</p>
        <?php endif; ?>

    <?php else: ?>
        <p class='alert-message message--bad'>Vous ne pouvez pas avoir accès à cette page</p>
        <div class='buttons'>

            <span class='button'>
                <?php echo $this->Html->link(
                        'Aller à l’accueil',
                        array('controller' => 'dynamicPages', 'action' => 'home'),
                        array('title' => 'Retourner à la page d’accueil')
                    );
                ?>
            </span>
        </div>
    <?php endif; ?>

</section>
