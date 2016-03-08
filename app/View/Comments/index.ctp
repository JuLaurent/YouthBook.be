<?php

    $this->assign('title', 'Commentaires ' . $comments[0]['Article']['title']);
    $this->assign('description', 'Commentaires de l’article' . $comments[0]['Article']['title']);

?>

<section class='bloc bloc--padding'>

    <div class='page-title'><h2 class='beta page-title__item'>Commentaires de <?php echo $comments[0]['Article']['title'] ?></h2></div>

    <div class='clearfix'>
            <div>
                <div class='comments'>
                    <? foreach( $comments as $comment ): ?>
                        <div class='comment'>
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
                                    <span class='comment__username'><?php echo $comment['User']['username'] ?></span>
                                    <span class='comment__date'><?php echo $this->Time->format('d/m/Y G:H:s', $comment['Comment']['created']) ?></span>
                                </div>
                            </div>
                            <div class='comment__content'><?php echo $comment['Comment']['content'] ?></div>
                        </div>
                      <?php endforeach; ?>
                </div>
            </div>

            <section>

                <div class='bloc-title'><h3>Ajouter un commentaire</h3></div>

                <?php if( $this->Session->check('Auth.User.id') ): ?>
                    <div class="form form--comment">
                        <?php
                            echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add'), 'novalidate' => true));
                                echo $this->Form->input('article_id', array('type' => 'hidden', 'value' => $comments[0]['Comment']['article_id']));
                                echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                echo $this->Wysiwyg->input('Comment.content', array('label' => 'Commentaire*', 'class' => 'form-textarea form-textarea--article wysi2'));
                            echo $this->Form->end(__('Publier le commentaire'));
                        ?>
                    </div>
                <?php else: ?>
                    <p>Connectez-vous pour publier un commentaire</p>
                <?php endif; ?>

            </section>
        </div>

</section>