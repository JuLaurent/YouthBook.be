<?php

    $this->assign('title', 'Requêtes');
    $this->assign('description', 'Liste des requêtes');

?>

<section>


    <div class='page-title'><h2 class='beta page-title__item'>Les requêtes</h2></div>

    <section>
        <div class='bloc-title'><h3>Les requêtes non accomplies</h3></div>

        <?php if( !empty($notDoneRequests) ): ?>
            <table class='table requests'>
                <caption class='hidden'>Liste des requêtes non accomplies</caption>
                <tr class='table__row'>
                    <th class='table__head table__head--book-title'>Titre du livre</th>
                    <th class='table__head'>Demandé par</th>
                    <th class='table__head'>Dernière requête</th>
                    <th class='table__head'>&nbsp;</th>
                </tr>
                <?php foreach( $notDoneRequests as $request ): ?>
                    <?php if( count($request['User']) == 1 ): ?>
                        <tr class='table__row table__row--data'>
                            <td class='table__data'>
                                <?php echo $this->Html->link(
                                    $request['Book']['title'],
                                    array('controller' => 'books', 'action' => 'view', 'slug' => $request['Book']['slug']),
                                    array('title' => 'Voir la fiche du livre' . $request['Book']['title'], 'class' => 'link'));
                                ?>
                            </td>
                            <td class='table__data'><?php echo $request['User']['0']['username'] ?></td>
                            <td class='table__data'><?php echo $this->Time->format('d/m/Y', $request['Request']['modified']) ?></td>
                            <td class='table__data table__data--button'>
                                <?php
                                    echo $this->Form->create('Request', array('novalidate' => true, 'url' => array('controller' => 'articles', 'action' => 'addStepOne'), 'class' => 'button button--100'));
                                        echo $this->Form->input('Article.Type.0', array('type' => 'hidden', 'value' => '1'));
                                        echo $this->Form->input('Article.Book.0', array('type' => 'hidden', 'value' => $request['Book']['id']));
                                    echo $this->Form->end(array('label' => 'Accepter la requête', 'class' => 'button--submit'));
                                ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr class='table__row table__row--data'>
                            <td rowspan='<?php echo count($request['User']) ?>' class='table__data'>
                                <?php echo $this->Html->link(
                                    $request['Book']['title'],
                                    array('controller' => 'books', 'action' => 'view', 'slug' => $request['Book']['slug']),
                                    array('title' => 'Voir la fiche du livre' . $request['Book']['title'], 'class' => 'link'));
                                ?>
                            </td>
                            <td class='table__data'><?php echo $request['User']['0']['username'] ?></td>
                            <td rowspan='<?php echo count($request['User']) ?>' class='table__data'><?php echo $this->Time->format('d/m/Y', $request['Request']['modified']) ?></td>
                            <td rowspan='<?php echo count($request['User']) ?>' class='table__data table__data--button'>
                                <?php
                                    echo $this->Form->create('Article', array('novalidate' => true, 'url' => array('controller' => 'articles', 'action' => 'addStepOne'), 'class' => 'button button--100'));
                                        echo $this->Form->input('Article.Type.0', array('type' => 'hidden', 'value' => '1'));
                                        echo $this->Form->input('Article.Book.0', array('type' => 'hidden', 'value' => $request['Book']['id']));
                                    echo $this->Form->end(array('label' => 'Accepter la requête', 'class' => 'button--submit'));
                                ?>
                            </td>
                        </tr>
                        <?php for( $i = 1 ; $i < count($request['User']) ; $i++ ): ?>
                            <tr>
                                <td class='table__data'><?php echo $request['User'][$i]['username'] ?></td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

            </table>

        <?php else: ?>

            <p>Aucune requête n’est disponible pour le moment.</p>

        <?php endif; ?>

    </section>

    <section>
        <div class='bloc-title'><h3>Les requêtes accomplies</h3></div>

        <ul>
            <?php foreach($doneRequests as $request): ?>
                <li>
                    <a href='<?php echo $this->Html->url( array( 'controller'=>'articlePages', 'action'=>'view', 'slug1' => $request['Article']['id'], 'slug2' => $request['Article']['slug'], 'slug3' => '1' )) ?>' title='Aller à la page de l&apos;article <?php echo $request['Article']['title'] ?>' class='link'>
                        <span class='link article-link'>
                            <span class='article-link__date'><?php echo $this->Time->format('d/m/Y', $request['Article']['created']) ?></span>
                            <span class='article-link__types'>
                                <?php foreach($request['Article']['Type'] as $type): ?>
                                    <span class='article-link__type'><?php echo $type['name'] ?></span>
                                <?php endforeach; ?>
                            </span>
                            <span class='article-link__title'><?php echo $request['Article']['title'] ?></span>
                            <span class='article-link__username'>par <?php echo $request['Article']['User']['username'] ?></span>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

</section>
