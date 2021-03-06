<?php

    $this->assign('title', 'Ajouter un article (3)');
    $this->assign('description', 'Ajout d’un article - étape trois');

?>


<section>

    <div class="page-title"><h2 class='beta page-title__item'>Ajouter un article - étape 3</h2></div>

    <div class='social-links social-links--left'>
        <span class='user__action'>
            <a href='<?php echo $this->Html->url( array( 'controller' => 'articles', 'action' => 'addStepTwo' ) ) ?>' title='Revenir à l’étape 2'>
                <span class="fa fa-arrow-left"></span>
            </a>
        </span>
    </div>

    <div class='bloc bloc--padding'>

        <?php if( $access == true ): ?>

            <?php echo $this->Flash->render(); ?>

            <div class="form form--article">
                <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

                <div class='alert-message message--warning'>
                    <p>Lorsque vous aurez fini de rédiger votre article, vous serez redirigez vers votre liste de brouillons.<br>Veuillez d’abord vérifier le brouillon de l’article en question avant de publier ce dernier.</p>
                    <noscript><p>Attention, désactiver JavaScript vous empêchera d’utiliser les outils de mise en forme.</p></noscript>
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
                  ?>
                  <?php if ($verif1 == true ): ?>
                      <div class='form__rating'>
                          <button data-rating='0' class='form__rating-button'>0</button>
                          <button data-rating='1' class='form__rating-button'>1</button>
                          <button data-rating='2' class='form__rating-button'>2</button>
                          <button data-rating='3' class='form__rating-button'>3</button>
                          <button data-rating='4' class='form__rating-button'>4</button>
                          <button data-rating='5' class='form__rating-button'>5</button>
                      </div>
                  <?php endif; ?>
                  <?php
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
