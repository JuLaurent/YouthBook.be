<?php

    $this->assign('title', 'Ajouter un livre');
    $this->assign('description', 'Ajout d’un livre sans ISBN');

?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Ajouter un livre</h2></div>

    <div class='bloc bloc--padding'>
        <p>Afin de vous faciliter la tâche, vous avez la possibilité d’ajouter un livre à l’aide de l’ISBN, ce qui remplira automatiquement certaines informations de la fiche.</p>

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

            <?php echo $this->Form->create('Book', array('enctype' => 'multipart/form-data', 'novalidate' => true)); ?>
                <?php
                    echo $this->Form->input('title', array('label' => 'Titre*', 'value' => $this->Session->read('book')['title'], 'class' => 'input-text'));
                    echo $this->Form->input('cover', array('type' => 'file', 'label' => 'Couverture (au format png, jpeg ou gif)', 'class' => 'input-file'));
                    echo $this->Form->input('chronology', array('options' => array('main' => 'Série principale', 'spinoff' => 'Spin-off'), 'label' => 'Chronologie*', 'class' => 'form-select'));
                    echo $this->Form->input('saga_id', array('label' => 'Saga', 'empty' => 'Aucune série', 'class' => 'form-select', 'data-placeholder' => 'Sélectionnez une saga'));
                    echo $this->Form->input('pages', array('label' => 'Nombre de pages', 'value' => $this->Session->read('book')['pageCount'], 'class' => 'input-number'));
                    echo $this->Form->input('author', array('label' => 'Auteur(s)', 'value' => $this->Session->read('book')['authors'][0], 'class' => 'input-text'));
                    echo $this->Form->input('release_date', array(
                        'label' => 'Date de sortie',
                        'dateFormat' => 'DMY',
                        'separator' => '',
                        'minYear' => '1700',
                        'value' => $this->Session->read('book')['publishedDate'],
                        'class' => 'select-date'
                    ));
                    echo $this->Form->input('publisher', array('label' => 'Éditeur', 'value' => $this->Session->read('book')['publisher'], 'class' => 'input-text'));
                    echo $this->Form->input('isbn10', array('label' => 'ISBN-10', 'value' => $this->Session->read('book')['industryIdentifiers'][0]['identifier'], 'placeholder' => '2070541274', 'class' => 'input-text'));
                    echo $this->Form->input('isbn13', array('label' => 'ISBN-13', 'value' => $this->Session->read('book')['industryIdentifiers'][1]['identifier'], 'placeholder' => '9782070541270', 'class' => 'input-text'));
                    echo $this->Form->input('summary', array('label' => 'Résumé', 'value' => $this->Session->read('book')['description'], 'class' => 'form-textarea'));
                    echo $this->Form->input('creator_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                ?>
            <?php echo $this->Form->end(__('Ajouter le livre'));?>
        </div>
    </div>

</section>
