<?php

    $this->assign('title', 'Livres');
    $this->assign('description', 'Liste de tous les livres');

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Les livres</h2></div>

    <section class='bloc'>
        <div class='bloc-title bloc-title--padding'><h3>Les derniers ajouts</h3></div>
        <div class='clearfix'>
            <?php foreach($lastBooks as $book): ?>
                <div class='image-box__cover'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' title='Aller à la fiche du livre <?php echo $book['Book']['title'] ?>' class='image-box__link'>
                        <div class='image-box__image'>
                            <?php
                                if( $book['Book']['cover'] ) {
                                    echo $this->Html->image('covers/' . $book['Book']['id'] . '/small_' . $book['Book']['cover'], array('alt' => 'Couverture du livre ' . $book['Book']['title']));
                                }
                                else {
                                    echo $this->Html->image('covers/noCoverSmall.png', array('alt' => 'Couverture de substitution'));
                                } ?>

                        </div>
                        <span class='image-box__information image-box__information--cover image-box__title image-box__title--cover'><?php echo $book['Book']['title'] ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <section class='bloc bloc--padding'>
        <div class='bloc-title'><h3>Tous les livres</h3></div>
        <div class='pagination'>
          <?php foreach($alphabet as $letter): ?>
              <span class='pagination__character character'>
                  <a  href='<?php echo($this->Html->url( array('controller' => 'books', 'action' => 'index', 'slug' => $letter))) ?>' title='Aller à la page des livres commençant par <?php echo($letter) ?>' class='<?php if($this->params['pass'][0] == $letter) echo('character__active ') ?>character__link'><?php echo($letter) ?></a>
              </span>
          <?php endforeach; ?>
      </div>
        <ul>
            <?php foreach($books as $book): ?>
                <li class='recent-article__item'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link'>
                        <?php echo $book['Book']['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <div>
        <p class='important'>Le livre que vous cherchez n’est pas répertorié ?</p>
        <div class='buttons'>
            <span class='button'>
                <?php echo $this->Html->link(
                        'Ajoutez-le',
                        array('controller' => 'books', 'action' => 'add'),
                        array('title' => 'Aller à la page d’ajout de livre')
                    );
                ?>
            </span>
        </div>
    </div>

</section>
