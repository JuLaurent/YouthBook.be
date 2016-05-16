<?php

    $this->assign('title', 'Modifier une saga');
    $this->assign('description', 'Modification d’une saga');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Modifier le titre</h2></div>

        <?php echo $this->Flash->render(); ?>

        <div class="form">
            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

            <?php echo $this->Form->create('Saga', array('enctype' => 'multipart/form-data', 'novalidate' => true)); ?>
                <?php
                    echo $this->Form->input('title', array('label' => 'Titre*', 'class' => 'input-text'));
                    echo $this->Form->input('id', array('type' => 'hidden'));
                ?>
            <?php echo $this->Form->end(__('Modifier le titre'));?>
        </div>
    </div>

</section>
