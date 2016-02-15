<?php

    $this->assign('title', 'Mes fiches');
    $this->assign('description', 'Liste de mes fiches de livres');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Mes fiches de livre</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $books != null ): ?>
            <ul class='collection'>
                <?php foreach($books as $book): ?>
                    <li class='recent-article__item collection__item'>
                        <?php /* foreach( $book['User'] as $user ) {
                            if( in_array( $this->Session->read('Auth.User.id'), $user ) ) {
                                echo $this->Form->create('Book', array('novalidate' => true, 'url' => array('controller' => 'users', 'action' => 'removeFromCollection'), 'class' => 'user__action user__action--form user__action--collection'));
                                        echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                        echo $this->Form->input('id', array('type' => 'hidden', 'value' => $book['Book']['id']));
                                echo $this->Form->end( array('label' => '-', 'title' => 'Enlever de ma liste de livres', 'class' => 'user__action--input user__action--remove'));
                            }
                            if( !in_array( $this->Session->read('Auth.User.id'), $user ) ) {
                                echo $this->Form->create('Book', array('novalidate' => true, 'url' => array('controller' => 'books', 'action' => 'addToCollection'), 'class' => 'user__action user__action--form user__action--collection'));
                                        echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                        echo $this->Form->input('id', array('type' => 'hidden', 'value' => $book['Book']['id']));
                                echo $this->Form->end( array('label' => '+', 'title' => 'Ajouter à ma liste de livres', 'class' => 'user__action--input user__action--add'));
                            }
                        } */ ?>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link'>
                            <?php echo $book['Book']['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez créé aucune fiche de livre.</p>
        <?php endif; ?>
    </div>

</section>
