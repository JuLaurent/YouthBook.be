<?php

    $this->assign('title', 'Ajouter un article (2)');
    $this->assign('description', 'Ajout d’un article - étape deux');

?>


<section>

    <div class='page-title'><h2 class='beta page-title__item'>Ajouter un article - étape 2</h2></div>

    <div class='bloc bloc--padding'>
        <?php if( $access == true ): ?>

            <?php echo $this->Flash->render(); ?>

            <div class='form form--article'>
                <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

                <div>
                    <div class='buttons'>
                        <span class='button'>
                            <?php echo $this->Html->link(
                                    'Étape précédente',
                                    array('controller' => 'articles', 'action' => 'addStepOne'),
                                    array('title' => 'Aller à l’étape 1')
                                );
                            ?>
                        </span>
                    </div>
                </div>

                <?php echo $this->Form->create('Article', array('enctype' => 'multipart/form-data', 'novalidate' => true));
                    if($verif2 == true) {
                        echo('<p class=\'alert-message message--warning\'>Attention, le nombre de pages ne pourra plus être modifié. Assurez vous de choisir le bon nombre.</p>');
                        echo $this->Form->input('number_of_pages', array('type' => 'number', 'label' => 'Nombre de pages (de 1 à 10)*', 'min' => '1', 'max' => '10', 'placeholder' => '1', 'class' => 'input-number input-number--article'));
                        echo $this->Form->end(__('Continuer'));
                    }
                    else{
                        if($verif1 == true && !($verif3 == true || $verif4 == true)) {
                            if( !empty($this->Session->read( 'currentSessionData' )['Article']['Book'] )) {
                                echo $this->Form->input('Article.Book', array('type' => 'select', 'label' => 'Livre*', 'value' => $this->Session->read( 'currentSessionData' )['Article']['Book'][0], 'class' => 'form-select form-select--article', 'data-placeholder' => 'Sélectionnez un livre'));
                            }
                            else {
                                echo $this->Form->input('Article.Book', array('type' => 'select', 'label' => 'Livre*', 'class' => 'form-select form-select--article', 'data-placeholder' => 'Sélectionnez un livre'));
                            }
                        }
                        else {
                            echo $this->Form->input('title', array('label' => 'Titre*', 'class' => 'input-text input-text--article'));
                            if( !empty($this->Session->read( 'currentSessionData' )['Article']['Book'] )) {
                                echo $this->Form->input('Article.Book', array('label' => 'Livre(s)*', 'multiple' => true, 'value' => $this->Session->read( 'currentSessionData' )['Article']['Book'][0], 'class' => 'form-select form-select--article', 'data-placeholder' => 'Sélectionnez un ou plusieurs livres'));
                            }
                            else {
                                echo $this->Form->input('Article.Book', array('label' => 'Livre(s)*', 'multiple' => true, 'class' => 'form-select form-select--article', 'data-placeholder' => 'Sélectionnez un ou plusieurs livres'));
                            }
                        }
                        echo $this->Wysiwyg->input('ArticlePage.0.content', array('label' => 'Contenu*', 'class' => 'form-textarea form-textarea--article wysiwyg'));
                        echo $this->Form->input('ArticlePage.0.page_number', array('type' => 'hidden', 'value' => '1'));
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
                    }
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
