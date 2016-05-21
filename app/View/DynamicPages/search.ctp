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
                  <ul itemscope itemtype='https://schema.org/ItemList'>
                      <?php foreach($books as $book): ?>
                        <li class='recent-article recent-article--book' itemprop='itemListElement' itemscope itemtype='https://schema.org/Book'>
                            <a href='<?php echo $this->Html->url( array( 'controller'=>'books', 'action'=>'view', 'slug' => $book['Book']['slug'] )) ?>' class='link' itemprop='url'>
                                <span itemprop='name'><?php echo $book['Book']['title'] ?></span>
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
                  <ul itemscope itemtype='https://schema.org/ItemList'>
                      <?php foreach($articles as $article): ?>
                          <li itemprop='itemListElement' itemscope itemtype='https://schema.org/Article'>
                              <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $article['Article']['id'], 'slug2' => $article['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $article['Article']['title'] ?>' class='link' itemprop='url'>
                                  <div class='recent-article recent-article--sheet'>
                                      <div class='recent-article__title recent-article__title--sheet' itemprop='name'><?php echo $article['Article']['title'] ?></div>
                                      <div class='recent-article__informations recent-article__informations--sheet clearfix'>
                                          <span class='recent-article__date' itemprop='datePublished'><?php echo $this->Time->format('d/m', $article['Article']['created']) ?></span>
                                          <span class='recent-article__types'>
                                              <?php foreach($article['Type'] as $type): ?>
                                                  <span class='recent-article__type'><?php echo $type['name'] ?></span>
                                              <?php endforeach; ?>
                                          </span>
                                          <span class='recent-article__author' itemprop='author'><?php echo $article['User']['username'] ?></span>
                                      </div>
                                  </div>
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
