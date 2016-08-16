<?php

    $this->assign('title', 'Modifier un article');
    $this->assign('description', 'Modification d’un article');

?>

<section>

    <div class="page-title"><h2 class='alpha page-title__item'>Modifier l’article</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $access == true ): ?>

            <?php echo $this->Flash->render(); ?>

            <div class="form form--article">
                <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>

                <noscript><p class='alert-message message--warning'>Attention, désactiver JavaScript vous empêchera d’utiliser les outils de mise en forme.</p></noscript>

                <?php echo $this->Form->create('Article', array('enctype' => 'multipart/form-data', 'novalidate' => true));
                    if($verif1 == true && ($verif2 == true || $verif3 == true || $verif4 == true) || $verif1 == false) {
                        echo $this->Form->input('title', array('label' => 'Titre*', 'class' => 'input-text input-text--article'));
                        echo $this->Form->input('Book', array('label' => 'Livre(s)*', 'class' => 'form-select form-select--article'));
                    }
                    if( $article['Article']['number_of_pages'] > '1' ) {
                        for($i = 0 ; $i < $article['Article']['number_of_pages'] ; $i++) {
                            echo $this->Wysiwyg->input('ArticlePage.' . $i . '.content', array('label' => 'Page ' . ($i + 1) . '*', 'class' => 'form-textarea form-textarea--article wysiwyg'));
                            echo $this->Form->input('ArticlePage.' . $i . '.id', array('type' => 'hidden'));
                        }
                    }
                    else {
                        echo $this->Wysiwyg->input('ArticlePage.0.content', array('label' => 'Contenu', 'class' => 'form-textarea form-textarea--article wysiwyg'));
                        echo $this->Form->input('ArticlePage.0.id', array('type' => 'hidden'));
                    }
                    if($verif1 == true) {
                        echo $this->Form->input('rating', array('label' => 'Appréciation (sur 5)*', 'min' => '0', 'max' => '5', 'placeholder' => '0', 'class' => 'input-number input-number--article'));
                    }
                ?>
                <div class='form__rating'>
                    <button data-rating='0' class='form__rating-button'>0</button>
                    <button data-rating='1' class='form__rating-button'>1</button>
                    <button data-rating='2' class='form__rating-button'>2</button>
                    <button data-rating='3' class='form__rating-button'>3</button>
                    <button data-rating='4' class='form__rating-button'>4</button>
                    <button data-rating='5' class='form__rating-button'>5</button>
                </div>
                <?php
                    if( $this->Session->read('Auth.User.role') == 'administrateur' ) {
                        echo $this->Form->input('highlighted', array('label' => 'Mise en évidence', 'input-checkbox input-checkbox--article'));
                        echo $this->Form->input('thumbnail', array('type' => 'file', 'label' => 'Thumbnail (au format png, jpeg ou gif)', 'class' => 'input-file input-file--article'));
                    }
                    echo $this->Form->input('id', array('type' => 'hidden'));
                    echo $this->Form->end(__('Modifier l’article'));
                ?>

            </div>

        <?php else: ?>
            <p class='alert-message message--bad'>Vous ne pouvez pas avoir accès à cette page</p>
            <div class='buttons'>

                <span class='button'>
                    <?php echo $this->Html->link(
                            'Retourner à l’article',
                            array('controller' => 'articlePages', 'action' => 'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1'),
                            array('title' => 'Retourner à la première page de l’article ' . $article['Article']['title'] )
                        );
                    ?>
                </span>
            </div>
        <?php endif; ?>
    </div>

</section>
