<?php

    $this->assign('title', 'Modifier la fiche');
    $this->assign('description', 'Modifier les informations de la fiche du livre ' . $book['Book']['title']);

?>

<?php // echo $this->element('book-nav'); ?>

<section>

    <div class="page-title"><h2 class='beta page-title__item'>Modifier la fiche</h2></div>

    <div class='bloc bloc--padding'>

        <?php if($this->Session->read('Auth.User.id') == $book['Book']['creator_id'] || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur'): ?>

            <?php echo $this->Session->flash(); ?>

            <div class="form">

                <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

                <?php echo $this->Form->create('Book', array('enctype' => 'multipart/form-data', 'novalidate' => true));?>
                    <?php
                        echo $this->Form->input('title', array('label' => 'Titre*', 'class' => 'input-text'));
                    ?>
                    <div class='form__bloc'>
                        <span class='form__span'>Couverture actuelle</span>
                        <div class='form__image image-box__cover'>
                            <div class='image-box__image'>
                                <?php
                                    if( $book['Book']['cover'] ) {
                                        echo $this->Html->image('covers/' . $book['Book']['id'] . '/small_' . $book['Book']['cover'], array('alt' => 'Couverture du livre' . $book['Book']['title'], 'srcset' => $this->webroot . 'img/covers/' . $book['Book']['id'] . '/small_' . $book['Book']['cover'] . ' 1x, ' . $this->webroot . 'img/covers/' . $book['Book']['id'] . '/smallHR_' . $book['Book']['cover'] . ' 2x', 'width' => '126', 'height' => '200'));
                                    }
                                    else {
                                        echo $this->Html->image('covers/noCoverSmall.png', array('alt' => 'Couverture de substitution', 'srcset' => $this->webroot . 'img/covers/small_noCover.png 1x, ' . $this->webroot . 'img//covers/smallHR_noCover.png 2x', 'width' => '126', 'height' => '200'));
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        echo $this->Form->input('cover', array('type' => 'file', 'label' => 'Couverture (au format png, jpeg ou gif)', 'class' => 'input-file'));
                        echo $this->Form->input('chronology', array('options' => array('main' => 'Série principale', 'spinoff' => 'Spin-off'), 'label' => 'Chronologie*', 'class' => 'form-select'));
                        echo $this->Form->input('pages', array('label' => 'Nombre de pages', 'class' => 'input-number'));
                        echo $this->Form->input('author', array('label' => 'Auteur(s)', 'class' => 'input-text'));
                        echo $this->Form->input('release_date', array(
                            'label' => 'Date de sortie',
                            'dateFormat' => 'DMY',
                            'separator' => '',
                            'minYear' => '1900',
                            'class' => 'select-date'
                        ));
                        echo $this->Form->input('publisher', array('label' => 'Éditeur', 'class' => 'input-text'));
                        echo $this->Form->input('isbn10', array('label' => 'ISBN-10', 'placeholder' => '2070541274', 'class' => 'input-text'));
                        echo $this->Form->input('isbn13', array('label' => 'ISBN-13', 'placeholder' => '9782070541270', 'class' => 'input-text'));
                        echo $this->Form->input('summary', array('label' => 'Résumé', 'class' => 'form-textarea'));
                        echo $this->Form->input('id', array('type' => 'hidden'));
                    ?>
                <?php echo $this->Form->end(__('Modifier la fiche'));?>

            </div>

          <?php else: ?>
              <p class='alert-message message--bad'>Vous ne pouvez pas avoir accès à cette page</p>
              <div class='buttons'>

                  <span class='button'>
                      <?php echo $this->Html->link(
                              'Retourner à la fiche',
                              array('controller' => 'books', 'action' => 'view', 'slug' => $book['Book']['slug']),
                              array('title' => 'Retourner à la fiche du livre ' . $book['Book']['title'])
                          );
                      ?>
                  </span>
              </div>
          <?php endif; ?>

    </div>

</section>
