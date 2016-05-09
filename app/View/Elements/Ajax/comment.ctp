<div class='comment'>
    <div class='comment__actions'>
        <?php if( $comment['Comment']['deleted'] == 0 ): ?>
            <span class='comment__number-of-likes'>
                <span><?php echo $comment['Comment']['number_of_likes'] ?></span>
                <span class='comment__like-icon'><?php echo $this->Html->image('icons/number-of-likes.svg', array('alt' => 'Avatar de substitution', 'width' => '25', 'height' => '25')); ?></span>
            </span>
            <?php
                $likedByUser = false;
                foreach( $comment['Like'] as $like ) {

                    if( $likedByUser = in_array( $this->Session->read('Auth.User.id'), $like ) == true ) {
                        break;
                    }
                }
                if( $likedByUser == true ) {
                    echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'dislike'), 'novalidate' => true, 'class' => 'user__action user__action--form comment__form'));
                        echo $this->Form->input('id', array('type' => 'hidden', 'value' => $comment['Comment']['id']));
                        echo $this->Form->input('number_of_likes', array('type' => 'hidden', 'value' => $comment['Comment']['number_of_likes'] - 1));
                        echo $this->Form->input('Like.0.comment_id', array('type' => 'hidden', 'value' => $comment['Comment']['id']));
                        echo $this->Form->input('Like.0.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                    echo $this->Form->end( array( 'label' => 'Ne plus aimer ce commentaire', 'title' => 'Ne plus aimer ce commentaire', 'class' => 'user__action--input comment__icon comment__dislike'));
                }
                else {
                    echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'like'), 'novalidate' => true, 'class' => 'user__action user__action--form comment__form'));
                        echo $this->Form->input('id', array('type' => 'hidden', 'value' => $comment['Comment']['id']));
                        echo $this->Form->input('number_of_likes', array('type' => 'hidden', 'value' => $comment['Comment']['number_of_likes'] + 1));
                        echo $this->Form->input('Like.0.comment_id', array('type' => 'hidden', 'value' => $comment['Comment']['id']));
                        echo $this->Form->input('Like.0.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                    echo $this->Form->end( array( 'label' => 'Aimer ce commentaire', 'title' => 'Aimer ce commentaire', 'class' => 'user__action--input comment__icon comment__like'));
                }
            ?>
        <?php endif; ?>
        <?php
            if( ( ( $comment['Comment']['user_id'] == $this->Session->read('Auth.User.id') && ( $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur' ) ) || ( $comment['Comment']['user_id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur' ) ) && $comment['Comment']['deleted'] == 0 ) {
                echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'delete'), 'novalidate' => true, 'class' => 'user__action user__action--form comment__form'));
                    echo $this->Form->input('id', array('type' => 'hidden', 'value' => $comment['Comment']['id']));
                    echo $this->Form->input('content', array('type' => 'hidden', 'value' => '<p class=\'message message--bad\'>Ce commentaire a été supprimé</p>'));
                    echo $this->Form->input('deleted', array('type' => 'hidden', 'value' => true));
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
            <span class='comment__username'><?php echo $comment['User']['username'] ?></span>
            <span class='comment__date'><?php echo $this->Time->format('d/m/Y G:H:s', $comment['Comment']['created']) ?></span>
        </div>
    </div>
    <div class='comment__content'><?php echo $comment['Comment']['content'] ?></div>
</div>
