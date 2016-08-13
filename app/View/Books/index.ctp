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
                <div class='image-box__cover' itemscope itemtype='https://schema.org/Book'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' title='Aller à la fiche du livre <?php echo $book['Book']['title'] ?>' class='image-box__link' itemprop='url'>
                        <?php
                            if( $book['Book']['cover'] ) {
                                echo $this->Html->image('covers/' . $book['Book']['id'] . '/small_' . $book['Book']['cover'], array('alt' => 'Livre ' . $book['Book']['title'], 'srcset' => $this->webroot . 'img/covers/' . $book['Book']['id'] . '/small_' . $book['Book']['cover'] . ' 1x, ' . $this->webroot . 'img/covers/' . $book['Book']['id'] . '/smallHR_' . $book['Book']['cover'] . ' 2x', 'width' => '126', 'height' => '200', 'class' => 'image-box__image image-box__image--cover', 'itemprop' => 'image'));
                            }
                            else {
                                echo $this->Html->image('covers/small_noCover.png', array('alt' => 'Couverture de substitution', 'srcset' => $this->webroot . 'img/covers/small_noCover.png 1x, ' . $this->webroot . 'img/covers/smallHR_noCover.png 2x', 'width' => '126', 'height' => '200', 'class' => 'image-box__image image-box__image--cover', 'itemprop' => 'image'));
                            }
                        ?>
                        <span class='image-box__information image-box__information--cover image-box__title image-box__title--cover' itemprop='name'><?php echo $book['Book']['title'] ?></span>
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
        <ul itemscope itemtype='https://schema.org/ItemList'>
            <?php foreach($books as $book): ?>
                <li class='recent-article recent-article--book' itemprop='itemListElement' itemscope itemtype='https://schema.org/Book'>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link' itemprop='url'>
                        <span itemprop='name'><?php echo $book['Book']['title'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <div class='bloc bloc--padding'>
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
