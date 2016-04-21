<?php

    $this->assign('title', 'Ajouter un article (3)');
    $this->assign('description', 'Ajout d’un article - étape trois');

?>


<section>

    <div class="page-title"><h2 class='beta page-title__item'>Ajouter un article - étape 3</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $access == true ): ?>

            <?php echo $this->Flash->render(); ?>

            <div class="form form--article">
                <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

                <div>
                    <div class='buttons'>
                        <span class='button'>
                            <?php echo $this->Html->link(
                                    'Étape précédente',
                                    array('controller' => 'articles', 'action' => 'addStepTwo'),
                                    array('title' => 'Aller à l’étape 2')
                                );
                            ?>
                        </span>
                    </div>
                </div>

                <?php
                    echo $this->Form->create('Article', array('enctype' => 'multipart/form-data', 'novalidate' => true));
                        echo $this->Form->input('title', array('label' => 'Titre*', 'class' => 'input-text input-text--article'));
                        if( !empty($this->Session->read( 'currentSessionData' )['Article']['Book'] )) {
                            echo $this->Form->input('Article.Book', array('label' => 'Livre(s)*', 'multiple' => true, 'value' => $this->Session->read( 'currentSessionData' )['Article']['Book'][0], 'class' => 'form-select form-select--article', 'data-placeholder' => 'Sélectionnez un ou plusieurs livres'));
                        }
                        else {
                            echo $this->Form->input('Article.Book', array('label' => 'Livre(s)*', 'multiple' => true, 'class' => 'form-select form-select--article', 'data-placeholder' => 'Sélectionnez un ou plusieurs livres'));
                        }
                        for($i = 0 ; $i < $this->Session->read('currentSessionData')['Article']['number_of_pages'] ; $i++) {
                            echo $this->Wysiwyg->input('ArticlePage.' . $i . '.content', array('label' => 'Page ' . ($i + 1) . '*', 'class' => 'form-textarea form-textarea--article wysiwyg'));
                            echo $this->Form->input('ArticlePage.' . $i . '.page_number', array('type' => 'hidden', 'value' => $i + 1));
                        }
                        if($verif1 == true) {
                            echo $this->Form->input('rating', array('label' => 'Appréciation (sur 5)*', 'min' => '0', 'max' => '5', 'placeholder' => '0', 'class' => 'input-number input-number--article'));
                        }
                        if( $this->Session->read('Auth.User.role') == 'administrateur' ) {
                            echo $this->Form->input('highlighted', array('label' => 'Mise en évidence', 'input-number input-number--article'));
                            echo $this->Form->input('thumbnail', array('type' => 'file', 'label' => 'Thumbnail (au format png, jpeg ou gif)', 'class' => 'input-file input-file--article'));
                        }
                        echo $this->Form->input('draft', array('type' => 'hidden', 'value' => 1));
                        echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                    echo $this->Form->end(__('Ajouter aux brouillons'));
                ?>

            </div>

        <?php else: ?>
            <p class='alert-message message--bad'>Vous ne pouvez pas avoir accès à cette page</p>
            <div class='buttons'>

                <span class='button'>
                    <?php echo $this->Html->link(
                            'Retourner à l’étape 1',
                            array('controller' => 'articles', 'action' => 'addStepOne'),
                            array('title' => 'Retourner à la première page de la rédaction d’article')
                        );
                    ?>
                </span>
            </div>
        <?php endif; ?>
    </div>

</section>
