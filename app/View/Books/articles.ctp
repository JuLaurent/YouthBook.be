<?php

    $this->assign('title', ucfirst($slug2) . ' du livre ' . $book['Book']['title']);
    $this->assign('description', 'Liste des ' . $slug2 . ' du livre ' . $book['Book']['title']);

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Les <?php echo $slug2 ?> sur <?php echo $book['Book']['title'] ?></h2></div>

    <div class='bloc bloc--padding'>
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

        <div>
            <div class='buttons'>
                <span class='button'>
                    <?php echo $this->Html->link(
                            'Page précédente',
                            array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']),
                            array('title' => 'Revenir à la fiche du livre' . $book['Book']['title'])
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
        </div>
    </div>

</section>
