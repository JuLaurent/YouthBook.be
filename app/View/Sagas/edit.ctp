<?php

    $this->assign('title', 'Modifier une saga');
    $this->assign('description', 'Modification de la fiche de la saga ' . $saga['Saga']['title']);

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Modifier le titre</h2></div>

    <div class='bloc bloc--padding'>

        <?php if($this->Session->read('Auth.User.id') == $saga['Saga']['user_id'] || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur'): ?>

            <?php echo $this->Flash->render(); ?>

            <div class="form">
                <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

                <?php echo $this->Form->create('Saga', array('enctype' => 'multipart/form-data', 'novalidate' => true)); ?>
                    <?php
                        echo $this->Form->input('title', array('label' => 'Titre*', 'class' => 'input-text'));
                        echo $this->Form->input('Book', array('label' => 'Livre(s)*', 'multiple' => true, 'class' => 'form-select', 'data-placeholder' => 'Sélectionnez un ou plusieurs livres'));
                        echo $this->Form->input('id', array('type' => 'hidden'));
                    ?>
                <?php echo $this->Form->end(__('Modifier la saga'));?>
            </div>
        <?php else: ?>
            <p class='alert-message message--bad'>Vous ne pouvez pas avoir accès à cette page</p>
            <div class='buttons'>

                <span class='button'>
                    <?php echo $this->Html->link(
                            'Retourner à la fiche',
                            array('controller' => 'sagas', 'action' => 'view', 'slug' => $saga['Saga']['slug']),
                            array('title' => 'Retourner à la fiche de la saga ' . $saga['Saga']['title'])
                        );
                    ?>
                </span>
            </div>
        <?php endif; ?>

    </div>

</section>
