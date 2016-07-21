<?php

    $this->assign('title', 'Demandes critiques');
    $this->assign('description', 'Liste des demandes de critiques');

?>

<section>


    <div class='page-title'><h2 class='beta page-title__item'>Les demandes de critiques</h2></div>

    <section class='bloc bloc--padding'>
        <div class='bloc-title'><h3>Les demandes non accomplies</h3></div>

        <?php if( !empty($notDoneRequests) ): ?>
            <table class='table requests' itemscope itemprop='https://schema.org/Table'>
                <caption class='hidden'>Liste des demandes non accomplies</caption>
                <tr class='table__row'>
                    <th id='title' class='table__head table__head--book-title'>Titre du livre</th>
                    <th id='requesters' class='table__head'>Demandé par</th>
                    <th id='last-request'class='table__head'>Dernière demande</th>
                    <th id='button' class='table__head'>&nbsp;</th>
                </tr>
                <?php foreach( $notDoneRequests as $request ): ?>
                    <tr class='table__row table__row--data'>
                        <td class='table__data' headers='title' data-head='Titre du livre'>
                            <?php echo $this->Html->link(
                                $request['Book']['title'],
                                array('controller' => 'books', 'action' => 'view', 'slug' => $request['Book']['slug']),
                                array('title' => 'Voir la fiche du livre' . $request['Book']['title'], 'class' => 'link'));
                            ?>
                        </td>
                        <td class='table__data' headers='requesters' data-head='Demandé par'>
                            <?php echo $request['User']['0']['username'] ?>
                            <?php
                                if( count($request['User']) > 1 ) {
                                    for( $i = 1 ; $i < count($request['User']) ; $i++ ) {
                                        echo ', ' . $request['User'][$i]['username'];
                                    }
                                }
                            ?>
                        </td>
                        <td class='table__data' headers='last-request' data-head='Dernière demande'><?php echo $this->Time->format('d/m/Y', $request['Request']['modified']) ?></td>
                        <td class='table__data' headers='button' class='table__data--button'>
                            <?php
                                echo $this->Form->create('Request', array('novalidate' => true, 'url' => array('controller' => 'articles', 'action' => 'addStepOne'), 'class' => 'button button--100'));
                                    echo $this->Form->input('Article.Type.0', array('type' => 'hidden', 'value' => '1'));
                                    echo $this->Form->input('Article.Book.0', array('type' => 'hidden', 'value' => $request['Book']['id']));
                                echo $this->Form->end(array('label' => 'Accepter la demande', 'class' => 'button--submit'));
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>

        <?php else: ?>

            <p>Aucune demande de critique n’est disponible pour le moment.</p>

        <?php endif; ?>

    </section>

    <section class='bloc bloc--padding'>
        <div class='bloc-title'><h3>Les demandes accomplies</h3></div>

        <?php if( !empty($doneRequests) ): ?>
            <ul>
                <?php foreach($doneRequests as $request): ?>
                    <li class='recent-article__item recent-article__item--sheet'>
                        <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $request['Article']['id'], 'slug2' => $request['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de la critique <?php echo $request['Article']['title'] ?>' class='link'>
                            <div class='recent-article recent-article--sheet'>
                                <div class='recent-article__title recent-article__title--sheet'><?php echo $request['Article']['title'] ?></div>
                                <div class='recent-article__informations recent-article__informations--sheet clearfix'>
                                    <span class='recent-article__date'><?php echo $this->Time->format('d/m', $request['Article']['created']) ?></span>
                                    <span class='recent-article__author'><?php echo $request['Article']['User']['username'] ?></span>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune demande n’a encore été accomplie.</p>
        <?php endif; ?>
    </section>

</section>
