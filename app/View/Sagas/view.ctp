<?php

    $this->assign('title', $saga['Saga']['title']);
    $this->assign('description', 'La saga' . $saga['Saga']['title']);

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'><?php echo $saga['Saga']['title'] ?></h2></div>

    <?php if( !empty( $main ) ): ?>
        <section class='bloc'>
            <div class='bloc-title bloc-title--padding'><h3>La série principale</h3></div>

            <ul>
                <?php foreach($main as $book): ?>
                    <li class='recent-article recent-article--book'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link'>
                            <?php echo $book['Book']['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </section>
    <?php endif; ?>

    <?php if( !empty( $spinoff ) ): ?>
        <section class='bloc'>
            <div class='bloc-title bloc-title--padding'><h3>Les spin-off</h3></div>

            <ul>
                <?php foreach($spinoff as $book): ?>
                    <li class='recent-article recent-article--book'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link'>
                            <?php echo $book['Book']['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </section>
    <?php endif; ?>

    <?php if( empty( $main ) && empty( $spinoff ) ) ?>
        <p>Aucun livre n’a encore été ajouté à cette saga</p>

    <?php if( $saga['Saga']['user_id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'administrateur' || $this->Session->read('Auth.User.role') == 'modérateur' ): ?>
        <div>
            <div class='buttons'>
                <span class='button'>
                    <?php echo $this->Html->link(
                            'Modifier le titre',
                            array('controller' => 'sagas', 'action' => 'edit', 'slug' => $saga['Saga']['slug']),
                            array('title' => 'Aller à la page de modification de la saga')
                        );
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

</section>
