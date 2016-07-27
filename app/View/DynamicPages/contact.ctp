<?php

    $this->assign('title', 'Contact');
    $this->assign('description', 'Ajout d’un livre avec ISBN');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Contact</h2></div>

    <div class='bloc bloc--padding'>
        <p>Une question ? Une remarque ? Une suggestion ? Contactez-nous.</p>

        <?php echo $this->Flash->render(); ?>

            <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

            <?php
                    echo $this->Wysiwyg->input('text', array('label' => 'Message*', 'class' => 'form-textarea form-textarea--article wysi2'));
                echo $this->Form->end(__('Envoyer le mail'));
            ?>
        </div>
    </div>

</section>
