<?php

    $this->assign('title', 'Ajouter un livre');
    $this->assign('description', 'Ajout d’un livre avec ISBN');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Ajouter un livre</h2></div>

    <div class='bloc bloc--padding'>
        <p>Afin de vous faciliter la tâche, vous avez la possibilité d’ajouter un livre à l’aide de l’ISBN, ce qui remplira automatiquement certaines informations de la fiche.</p>
        <p class='alert-message message--warning'>Attention toutefois, cette recherche par ISBN ne donne pas un résultat correct à tous les coups. <br> Si vous obtenez de mauvaises informations, privilégiez donc l’ajout sans ISBN ou corriger les informations à la main.</p>

        <div class='buttons'>
            <span class='button'>
                <?php echo $this->Html->link(
                        'Ajouter avec l’ISBN',
                        array('controller' => 'books', 'action' => 'addWithIsbn'),
                        array('title' => 'Ajouter un livre avec l’ISBN', 'class' => '')
                    );
                ?>
            </span>
            <span class='button'>
                <?php echo $this->Html->link(
                        'Ajouter sans l’ISBN',
                        array('controller' => 'books', 'action' => 'addWithoutIsbn'),
                        array('title' => 'Ajouter un livre sans l’ISBN', 'class' => '')
                    );
                ?>
            </span>
        </div>

        <?php echo $this->Flash->render(); ?>

        <div class="form">
            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

            <?php echo $this->Form->create('Book', array('novalidate' => true)); ?>
                <?php
                    echo $this->Form->input('isbn', array('label' => 'ISBN*', 'placeholder' => '9782070541270', 'class' => 'input-text'));
                ?>
            <?php echo $this->Form->end(__('Vérifier les informations'));?>
        </div>
    </div>

</section>
