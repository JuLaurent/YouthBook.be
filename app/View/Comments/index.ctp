<?php

    $this->assign('title', 'Commentaires ' . $comments[0]['Article']['title']);
    $this->assign('description', 'Commentaires de l’article' . $comments[0]['Article']['title']);

?>

<section class='bloc bloc--padding'>

    <div class='page-title'><h2 class='beta page-title__item'>Commentaires de <?php echo $comments[0]['Article']['title'] ?></h2></div>

    <div class='clearfix bloc--comments'>
        <div class='bloc comments'>
            <?php foreach( $comments as $comment ): ?>
                <div class='comment' itemscope itemtype='https://schema.org/Comment'>
                    <div class='comment__actions'>
                        <?php if( $comment['Comment']['deleted'] == 0 ): ?>
                            <span class='comment__number-of-likes'>
                                <span class='comment__number'><?php echo $comment['Comment']['number_of_likes'] ?></span>
                                <span class='comment__like-icon'><?php echo $this->Html->image('icons/number-of-likes.svg', array('alt' => 'Like', 'width' => '25', 'height' => '25')); ?></span>
                            </span>
                            <?php
                                if ( $this->Session->check('Auth.User.id') ) {
                                    $likedByUser = false;
                                    foreach( $comment['Like'] as $like ) {
                                        if( $likedByUser = in_array( $this->Session->read('Auth.User.id'), $like ) == true ) {
                                            break;
                                        }
                                    }
                                    if( $likedByUser == true ) {
                                        echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'dislike'), 'novalidate' => true, 'class' => 'user__action user__action--form comment__form ajax__like'));
                                            echo $this->Form->input('id', array('type' => 'hidden', 'value' => $comment['Comment']['id'], 'class' => 'ajax__like--id'));
                                            echo $this->Form->input('number_of_likes', array('type' => 'hidden', 'value' => $comment['Comment']['number_of_likes'] - 1, 'class' => 'ajax__like--number-of-likes'));
                                            echo $this->Form->input('Like.0.comment_id', array('type' => 'hidden', 'value' => $comment['Comment']['id'], 'class' => 'ajax__like--like-comment-id'));
                                            echo $this->Form->input('Like.0.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'), 'class' => 'ajax__like--like-user-id'));
                                        echo $this->Form->end( array( 'label' => 'Ne plus aimer ce commentaire', 'title' => 'Ne plus aimer ce commentaire', 'class' => 'user__action--input comment__icon comment__dislike'));
                                    }
                                    else {
                                        echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'like'), 'novalidate' => true, 'class' => 'user__action user__action--form comment__form ajax__like'));
                                            echo $this->Form->input('id', array('type' => 'hidden', 'value' => $comment['Comment']['id'], 'class' => 'ajax__like--id'));
                                            echo $this->Form->input('number_of_likes', array('type' => 'hidden', 'value' => $comment['Comment']['number_of_likes'] + 1, 'class' => 'ajax__like--number-of-likes'));
                                            echo $this->Form->input('Like.0.comment_id', array('type' => 'hidden', 'value' => $comment['Comment']['id'], 'class' => 'ajax__like--like-comment-id'));
                                            echo $this->Form->input('Like.0.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'), 'class' => 'ajax__like--like-user-id' ));
                                        echo $this->Form->end( array( 'label' => 'Aimer ce commentaire', 'title' => 'Aimer ce commentaire', 'class' => 'user__action--input comment__icon comment__like'));
                                    }
                                }
                            ?>
                        <?php endif; ?>
                        <?php
                            if( ( ( $comment['Comment']['user_id'] == $this->Session->read('Auth.User.id') && ( $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur' ) ) || ( $comment['Comment']['user_id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur' ) ) && $comment['Comment']['deleted'] == 0 ) {
                                echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'delete'), 'novalidate' => true, 'class' => 'user__action user__action--form comment__form ajax__comment-delete'));
                                    echo $this->Form->input('id', array('type' => 'hidden', 'value' => $comment['Comment']['id'], 'class' => 'ajax__comment-delete--id'));
                                    echo $this->Form->input('content', array('type' => 'hidden', 'value' => '<p class=\'message message--bad\'>Ce commentaire a été supprimé</p>', 'class' => 'ajax__comment-delete--content'));
                                    echo $this->Form->input('deleted', array('type' => 'hidden', 'value' => true, 'class' => 'ajax__comment-delete--deleted'));
                                echo $this->Form->end( array( 'label' => 'Supprimer ce commentaire', 'title' => 'Supprimer ce commentaire', 'class' => 'user__action--input comment__icon comment__delete'));
                            }
                        ?>
                    </div>
                    <div class='clearfix'>
                        <span class='user__avatar user__avatar--article comment__avatar'>
                            <?php
                                if( $comment['User']['avatar'] ) {
                                    echo $this->Html->image('avatars/' . $comment['Comment']['user_id'] . '/small_' . $comment['User']['avatar'], array('alt' => 'Votre avatar', 'srcset' => $this->webroot . 'img/avatars/' . $comment['Comment']['user_id'] . '/small_' . $comment['User']['avatar'] . ' 1x, ' . $this->webroot . 'img/avatars/' . $comment['Comment']['user_id'] . '/smallHR_' . $comment['User']['avatar'] . ' 2x', 'width' => '48', 'height' => '48'));
                                }
                                else {
                                    echo $this->Html->image('avatars/small_noAvatar.png', array('alt' => 'Avatar de substitution', 'srcset' => $this->webroot . 'img/avatars/small_noAvatar.png 1x, ' . $this->webroot . 'img/avatars/smallHR_noAvatar.png 2x', 'width' => '48', 'height' => '48'));
                                }
                            ?>
                        </span>
                        <div class='comment__info'>
                            <span class='comment__username' itemprop='author'><?php echo $comment['User']['username'] ?></span>
                            <span class='comment__date' itemprop='datePublished'><?php echo $this->Time->format('d/m/Y G:H:s', $comment['Comment']['created']) ?></span>
                        </div>
                    </div>
                    <div class='comment__content' itemprop='text'><?php echo $comment['Comment']['content'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <section>
            <div class='bloc-title'><h3>Ajouter un commentaire</h3></div>

            <?php echo $this->Flash->render(); ?>

            <?php if( $this->Session->check('Auth.User.id') ): ?>
                <div class="form form--comment">
                    <p class='alert-message'>Les champs marqué d’un astérisque (*) sont obligatoires.</p>
                    <noscript><p class='alert-message message--warning'>Attention, désactiver JavaScript vous empêchera d’utiliser les outils de mise en forme.</p></noscript>
                    <?php
                        echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add'), 'novalidate' => true, 'class' => 'ajax__add-comment'));
                            echo $this->Wysiwyg->input('Comment.content', array('label' => 'Commentaire*', 'class' => 'form-textarea form-textarea--article wysi2 ajax__add-comment--content'));
                            echo $this->Form->input('article_id', array('type' => 'hidden', 'value' => $comments[0]['Comment']['article_id'], 'class' => 'ajax__add-comment--article-id'));
                            echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'), 'class' => 'ajax__add-comment--user-id'));
                        echo $this->Form->end(__('Publier le commentaire'));
                    ?>
                </div>
            <?php else: ?>
                <p>Connectez-vous pour publier un commentaire</p>
            <?php endif; ?>

        </section>
    </div>

</section>
