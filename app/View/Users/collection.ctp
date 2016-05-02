<?php

    $this->assign('title', 'Collection');
    $this->assign('description', 'Ma collection de livres');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Ma collection</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $collection != null ): ?>
            <ul class='collection'>
                <?php foreach($collection as $book): ?>
                    <li class='collection__item'>
                        <?php
                            echo $this->Form->create('Book', array('novalidate' => true, 'url' => array('controller' => 'users', 'action' => 'removeFromCollection'), 'class' => 'user__action user__action--form user__action--collection'));
                                    echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                    echo $this->Form->input('id', array('type' => 'hidden', 'value' => $book['Book']['id']));
                            echo $this->Form->end( array('label' => '-', 'title' => 'Enlever de ma liste de livres', 'class' => 'user__action--input user__action--remove'));
                        ?>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link'>
                            <?php echo $book['Book']['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez aucun livre dans votre collection.</p>
        <?php endif; ?>
    </div>

</section>
