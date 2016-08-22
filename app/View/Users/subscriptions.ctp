<?php

    $this->assign('title', 'Abonnements');
    $this->assign('description', 'Liste de mes abonnements');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Mes abonnements</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $subscriptions != null ): ?>
            <ul class='collection' itemscope itemtype='https://schema.org/ItemList'>
                <?php foreach( $subscriptions as $subscription ): ?>
                    <li class='collection__item' itemprop='itemListElement' itemscope itemtype='https://schema.org/Book'>
                        <?php
                            echo $this->Form->create('Subscription', array('novalidate' => true, 'url' => array('controller' => 'subscriptions', 'action' => 'unsubscribe'), 'class' => 'user__action user__action--form user__action--collection ajax__user-unsubscribe'));
                                echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'), 'class' => 'ajax__user-unsubscribe--user-id'));
                                echo $this->Form->input('Saga.id', array('type' => 'hidden', 'value' => $subscription['Saga']['id'], 'class' => 'ajax__user-unsubscribe--saga-id'));
                            echo $this->Form->end( array('label' => '-', 'title' => 'Me désabonner', 'class' => 'user__action--input user__action--remove'));
                        ?>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'sagas', 'action'=>'view', 'slug' => $subscription['Saga']['slug'] )) ?>' title="Aller à la fiche de la saga <?php echo $subscription['Saga']['title'] ?>" class='link' itemprop='url'>
                            <span itemprop='name'><?php echo $subscription['Saga']['title'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous êtes abonné à aucune saga.</p>
        <?php endif; ?>
    </div>

</section>
