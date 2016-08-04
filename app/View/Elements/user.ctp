<?php if($this->Session->check('Auth.User.id')): ?>
    <div class='user__left'>
        <span class='user__avatar'>
            <?php
                if($this->Session->read('Auth.User.avatar')) {
                    echo $this->Html->image('avatars/' . $this->Session->read('Auth.User.id') . '/thumb_' . $this->Session->read('Auth.User.avatar'), array('alt' => 'Votre avatar', 'srcset' => $this->webroot . 'img/avatars/' . $this->Session->read('Auth.User.id') . '/thumb_' . $this->Session->read('Auth.User.avatar') . ' 1x, ' . $this->webroot . 'img/avatars/' . $this->Session->read('Auth.User.id') . '/thumbHR_' . $this->Session->read('Auth.User.avatar') . ' 2x', 'width' => '71', 'height' => '71'));
                }
                else {
                    echo $this->Html->image('avatars/noAvatar.png', array('alt' => 'Avatar de substitution', 'srcset' => $this->webroot . 'img/avatars/thumb_noAvatar.png 1x, ' . $this->webroot . 'img/avatars/thumbHR_noAvatar.png 2x', 'width' => '71', 'height' => '71'));
                }
            ?>
        </span>
    </div>
    <div class='user__right'>
        <span class='user__username'>
            Bonjour <?php echo $this->Session->read('Auth.User.username') ?>
        </span>
        <div class='user__actions'>
            <span class='user__action action user__edit'>
                <a href='<?php echo $this->Html->url( array( 'controller'=>'users', 'action'=>'collection' ) ) ?>' title='Aller à la page de ma collection de livres' class='action__link<?php if($this->params['controller'] == 'users') echo ' action__active' ?>'>
                    <span class='hidden'>Mon profil</span>
                    <span class="fa fa-user"></span>
                </a>
            </span>
            <span class='user__action action'>
                <a href='<?php echo $this->Html->url( array( 'controller'=>'conversations', 'action'=>'index' ) ) ?>' title='Aller à la page de mes conversations' data-number='<?php echo $numberNotSeenConversations ?>' class='action__link<?php if($this->params['controller'] == 'conversations') echo ' action__active action__popup' ?>'>
                    <span class='hidden'>Mes conversations</span>
                    <span class="fa fa-comments"></span>
                    <?php if ( $numberNotSeenConversations > 0 ): ?>
                        <span class='user__not-seen-conversations'><?php echo $numberNotSeenConversations ?></span>
                    <?php endif; ?>
                </a>
                <?php if ( $numberNotSeenConversations > 0 ): ?>
                    <div class='bubble-popup'>
                        <div class='bubble-popup__items'>
                            <?php foreach($notSeenConversations as $conversation): ?>
                                <a href='<?php echo $this->Html->url( array('controller' => 'conversations', 'action' => 'view', 'slug' => $conversation['Conversation']['id']) ) ?>' title='Aller à la conversation <?php echo $conversation['Conversation']['title'] ?>' class='bubble-popup__item'>
                                    <span class='bubble-popup__information bubble-popup__information--title'><?php echo $conversation['Conversation']['title'] ?></span>
                                    <span class='bubble-popup__information'>
                                        <?php
                                            $j = 0;
                                            for( $i = 0 ; $i < count($conversation['User']) ; $i++ ) {
                                                if( $conversation['User'][$i]['username'] != $this->Session->read('Auth.User.username') ) {
                                                    if( $j == 0 ) {
                                                        echo $conversation['User'][$i]['username'];
                                                    }
                                                    else {
                                                        echo ', ' . $conversation['User'][$i]['username'];
                                                    }
                                                    $j++;
                                                }
                                            }
                                        ?>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <span class='bubble-popup__link-container'>
                            <?php
                                echo $this->Html->link(
                                    'Voir toutes les conversations',
                                    array('controller' => 'conversations', 'action' => 'index'),
                                    array('title' => 'Aller à la page de mes conversations', 'class' => 'bubble-popup__link')
                                );
                            ?>
                        </span>
                    </div>
                <?php endif; ?>
            </span>
            <span class='user__action action user__book-create'>
                <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'add' ) ) ?>' title='Ajouter un livre' class='action__edit<?php if($this->params['controller'] == 'books' && ($this->params['action'] == 'add' || $this->params['action'] == 'addWithIsbn' || $this->params['action'] == 'addWithoutIsbn')) echo ' action__active' ?>'>
                    <span class='hidden'>Ajouter un livre</span>
                    <span class="fa fa-book"></span>
                </a>
            </span>
            <span class='user__action action user__article-create'>
                <a href='<?php echo $this->Html->url( array( 'controller'=>'articles', 'action'=>'addStepOne' ) ) ?>' title='Ajouter un article' class='action__edit<?php if($this->params['controller'] == 'articles' && ($this->params['action'] == 'addStepOne' || $this->params['action'] == 'addStepTwo' || $this->params['action'] == 'addStepThree')) echo ' action__active' ?>'>
                    <span class='hidden'>Ajouter un article</span>
                    <span class="fa fa-file-text"></span>
                </a>
            </span>
            <span class='user__action action user__article-create'>
                <a href='<?php echo $this->Html->url( array( 'controller'=>'requests', 'action'=>'index' ) ) ?>' title='Voir les demandes de critiques' class='action__edit<?php if($this->params['controller'] == 'requests' && $this->params['action'] == 'index') echo ' action__active' ?>'>
                    <span class='hidden'>Les demandes de critiques</span>
                    <span class="fa fa-question"></span>
                </a>
            </span>
            <span class='user__action action user__logout'>
                <a href='<?php echo $this->Html->url( array( 'controller'=>'users', 'action'=>'logout' ) ) ?>' title='Se déconnecter' class='action__edit'>
                    <span class='hidden'>Se déconnecter</span>
                    <span class="fa fa-sign-out"></span>
                </a>
            </span>
        </div>

    </div>
<?php else: ?>
    <div class='user__buttons double-button'>
        <span class='user__login user__button double-button__button'>
            <?php echo $this->Html->link(
                    'Se connecter',
                    array('controller' => 'users', 'action' => 'login'),
                    array('title' => 'Aller à la page de connexion', 'class' => 'user__connect')
                );
            ?>
        </span> <!--
        --> <span class='user__add user__button double-button__button'>
            <?php echo $this->Html->link(
                    'Créer un compte',
                    array('controller' => 'users', 'action' => 'add'),
                    array('title' => 'Aller à la page de création de compte')
                );
            ?>
        </span>
    </div>

<?php endif; ?>
