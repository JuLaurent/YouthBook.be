<?php

    $this->assign('title', 'Ajouter saga');
    $this->assign('description', 'Ajout d’une saga');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Ajouter une saga</h2></div>

        <?php echo $this->Flash->render(); ?>

        <div class="form">
            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

            <?php echo $this->Form->create('Saga', array('enctype' => 'multipart/form-data', 'novalidate' => true)); ?>
                <?php
                    echo $this->Form->input('title', array('label' => 'Titre*', 'class' => 'input-text'));
                    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                ?>
            <?php echo $this->Form->end(__('Ajouter la saga'));?>
        </div>
    </div>

</section>
