<?php

    $this->assign('title', 'Mes brouillons');
    $this->assign('description', 'Mes brouillons');

?>

<?php echo $this->element('user-nav'); ?>

<section class='right-part'>

    <div class="page-title"><h2 class='beta page-title__item'>Mes brouillons</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( $drafts != null ): ?>
            <ul>
                <?php foreach($drafts as $draft): ?>
                    <li class='recent-article__item'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $draft['Article']['id'], 'slug2' => $draft['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $draft['Article']['title'] ?>' class='link'>
                            <span class='link article-link'>
                                <span class='article-link__title article-link__title--user'><?php echo $draft['Article']['title'] ?></span>
                                <span class='article-link__types'>
                                    <?php foreach($draft['Type'] as $type): ?>
                                        <span class='article-link__type'><?php echo $type['name'] ?></span>
                                    <?php endforeach; ?>
                                    <span class='article-link__date article-link__date--user'>(<?php echo $this->Time->format('d/m/Y', $draft['Article']['created']) ?>)</span>
                                </span>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez aucun brouillon en ce moment.</p>
        <?php endif; ?>

    </div>

</section>
