<?php

    $this->assign('title', 'Sagas');
    $this->assign('description', 'Liste de toutes les sagas');

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Les sagas</h2></div>

    <ul>
        <?php foreach($sagas as $saga): ?>
            <li class='recent-article__item'>
                <a href='<?php echo $this->Html->url( array( 'controller'=>'sagas', 'action'=>'view', 'slug' => $saga['Saga']['slug'] )) ?>' class='link'>
                    <?php echo $saga['Saga']['title'] ?>
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

</section>
