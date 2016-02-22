<?php

    $this->assign('title', 'Ajouter un article (1)');
    $this->assign('description', 'Ajout d’un article - étape un');

?>


<section>

    <div class="page-title"><h2 class='beta page-title__item'>Ajouter un article - étape 1</h2></div>

    <div class='bloc bloc--padding'>
        <?php echo $this->Session->flash(); ?>

        <div class='alert-message message--warning'>
            <p>Attention, assurez-vous que le ou les livres dont l’article parle sont répertoriés sur le site.</p>
            <p>Attention, les types de l’article ne pourront plus être modifiés. Assurez vous de choisir les bons.</p>
        </div>

        <div class="form">
            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>
            <?php
                echo $this->Form->create('Article', array('novalidate' => true));
                    echo $this->Form->input('Article.Type', array('type' => 'select', 'multiple' => 'checkbox', 'label' => 'Type(s)*'));
                echo $this->Form->end(__('Continuer'));
            ?>
        </div>
    </div>

</section>
