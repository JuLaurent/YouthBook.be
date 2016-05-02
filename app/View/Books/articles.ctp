<?php

    $this->assign('title', ucfirst($slug2) . ' du livre ' . $book['Book']['title']);
    $this->assign('description', 'Liste des ' . $slug2 . ' du livre ' . $book['Book']['title']);

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Les <?php echo $slug2 ?> sur <?php echo $book['Book']['title'] ?></h2></div>

    <div class='social-links social-links--left'>
        <span class='user__action'>
            <a href='<?php echo $this->Html->url( array( 'controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug'] ) ) ?>' title='Revenir à la fiche du livre <?php echo $book['Book']['title'] ?>'>
                <span class="fa fa-arrow-left"></span>
            </a>
        </span>
    </div>

    <div class='bloc bloc--padding'>
        <ul>
            <?php foreach($articles as $article): ?>

                <li>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link'>
                        <div class='recent-article recent-article--sheet'>
                            <div class='recent-article__title recent-article__title--sheet'><?php echo $article['Article']['title'] ?></div>
                            <div class='recent-article__informations recent-article__informations--sheet clearfix'>
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
        </ul>

        <div>
            <div class='buttons'>
                <span class='button'>
                    <?php echo $this->Html->link(
                            'Écrire un article',
                            array('controller' => 'articles', 'action' => 'addStepOne'),
                            array('title' => 'Écrire un nouvel article')
                        );
                    ?>
                </span>
            </div>
        </div>
    </div>

</section>
