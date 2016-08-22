<?php

    $this->assign('title', 'Sagas');
    $this->assign('description', 'Liste de toutes les sagas');

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Les sagas</h2></div>

    <div class='bloc bloc--padding'>

        <ul itemscope itemtype='https://schema.org/ItemList'>
            <?php foreach($sagas as $saga): ?>
                <li class='recent-article recent-article--book' itemprop='itemListElement' itemscope itemtype='https://schema.org/Series'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'sagas', 'action'=>'view', 'slug' => $saga['Saga']['slug'] )) ?>' title="Aller à la fiche de la saga <?php echo $saga['Saga']['title'] ?>" class='link' itemprop='url'>
                        <span itemprop='name'><?php echo $saga['Saga']['title'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div>
            <p class='important'>La saga que vous cherchez n’est pas répertoriée ?</p>
            <div class='buttons'>
                <span class='button'>
                    <?php
                        echo $this->Html->link(
                            'Ajoutez-là',
                            array('controller' => 'sagas', 'action' => 'add'),
                            array('title' => 'Aller à la page d’ajout de saga')
                        );
                    ?>
                </span>
            </div>
        </div>
    </div>

</section>
