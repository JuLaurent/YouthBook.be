<?php

    $this->assign('title', 'Recherches');
    $this->assign('description', 'Page des recherches');

?>

<section>

    <div class='page-title'><h2 class='beta page-title__item'>Recherches</h2></div>

    <div class='bloc bloc--padding'>

         <section>
              <div class='bloc-title'><h3>Les livres</h3></div>
              <?php if($books != null): ?>
                  <ul>
                      <?php foreach($books as $book): ?>
                        <li>
                            <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link'>
                                <?php echo $book['Book']['title'] ?>
                            </a>
                        </li>
                      <?php endforeach; ?>
                  </ul>
              <?php else: ?>
                  <p>Aucun livre trouvé<p>
              <?php endif; ?>

         </section>

         <section>
              <div class='bloc-title'><h3>Les articles</h3></div>
              <?php if($articles != null): ?>
                  <ul>
                      <?php foreach($articles as $article): ?>
                          <li>
                              <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link'>
                                  <span class='link article-link'>
                                      <span class='article-link__date'><?php echo $this->Time->format('d/m', $article['Article']['created']) ?></span>
                                      <span class='article-link__types'>
                                          <?php foreach($article['Type'] as $type): ?>
                                              <span class='article-link__type'><?php echo $type['name'] ?></span>
                                          <?php endforeach; ?>
                                      </span>
                                      <span class='article-link__title'><?php echo $article['Article']['title'] ?></span>
                                      <span class='article-link__username'>par <?php echo $article['User']['username'] ?></span>
                                  </span>
                              </a>
                          </li>
                      <?php endforeach; ?>
                  </ul>
              <?php else: ?>
                  <p>Aucun article trouvé<p>
              <?php endif; ?>

         </section>

    </div>

</section>
