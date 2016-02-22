<?php

    $this->assign('title', 'Requêtes');
    $this->assign('description', 'Liste des requêtes');

?>

<section>


    <div class='page-title'><h2 class='beta page-title__item'>Les requêtes</h2></div>

    <section>
        <div class='bloc-title'><h3>Les requêtes non accomplies</h3></div>

        <?php if( !empty($notDoneRequests) ): ?>
            <table>
                <caption class='hidden'>Liste des requêtes non accomplies</caption>
                <tr>
                    <th>Titre du livre</th>
                    <th>Demandé par</th>
                    <th>Dernière requête</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach( $notDoneRequests as $request ): ?>
                    <?php if( count($request['User']) == 1 ): ?>
                        <tr>
                            <td>
                                <?php echo $this->Html->link(
                                    $request['Book']['title'],
                                    array('controller' => 'books', 'action' => 'view', 'slug' => $request['Book']['slug']),
                                    array('title' => 'Voir la fiche du livre' . $request['Book']['title'] ));
                                ?>
                            </td>
                            <td><?php echo $request['User']['0']['username'] ?></td>
                            <td><?php echo $this->Time->format('d/m/Y', $request['Request']['modified']) ?></td>
                            <td>
                                <?php
                                    echo $this->Form->create('Request', array('novalidate' => true, 'url' => array('controller' => 'articles', 'action' => 'addStepOne'), 'class' => 'button'));
                                        echo $this->Form->input('Article.Type.0', array('type' => 'hidden', 'value' => '1'));
                                        echo $this->Form->input('Article.Book.0', array('type' => 'hidden', 'value' => $request['Book']['id']));
                                    echo $this->Form->end(array('label' => 'Accepter la requête', 'class' => 'button--submit'));
                                ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td rowspan='<?php echo count($request['User']) ?>'>
                                <?php echo $this->Html->link(
                                    $request['Book']['title'],
                                    array('controller' => 'books', 'action' => 'view', 'slug' => $request['Book']['slug']),
                                    array('title' => 'Voir la fiche du livre' . $request['Book']['title'] ));
                                ?>
                            </td>
                            <td><?php echo $request['User']['0']['username'] ?></td>
                            <td rowspan='<?php echo count($request['User']) ?>'><?php echo $this->Time->format('d/m/Y', $request['Request']['modified']) ?></td>
                            <td rowspan='<?php echo count($request['User']) ?>'>
                                <?php
                                    echo $this->Form->create('Article', array('novalidate' => true, 'url' => array('controller' => 'articles', 'action' => 'addStepOne'), 'class' => 'button'));
                                        echo $this->Form->input('Article.Type.0', array('type' => 'hidden', 'value' => '1'));
                                        echo $this->Form->input('Article.Book.0', array('type' => 'hidden', 'value' => $request['Book']['id']));
                                    echo $this->Form->end(array('label' => 'Accepter la requête', 'class' => 'button--submit'));
                                ?>
                            </td>
                        </tr>
                        <?php for( $i = 1 ; $i < count($request['User']) ; $i++ ): ?>
                            <tr>
                                <td><?php echo $request['User'][$i]['username'] ?></td>
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

        <table>
            <caption class='hidden'>Liste des requêtes non accomplies</caption>
            <tr>
                <th>Titre du livre</th>
                <th>Ecrit par</th>
                <th>Publié le</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach( $doneRequests as $request ): ?>
                <tr>
                    <td>
                        <?php echo $this->Html->link(
                            $request['Book']['title'],
                            array('controller' => 'books', 'action' => 'view', 'slug' => $request['Book']['slug']),
                            array('title' => 'Voir la fiche du livre' . $request['Book']['title'] ));
                        ?>
                    </td>
                    <td><?php echo $request['Article']['User']['username'] ?></td>
                    <td><?php echo $this->Time->format('d/m/Y', $request['Article']['created']) ?></td>
                    <td>
                      <span class='button'>
                        <?php echo $this->Html->link(
                                'Voir la critique',
                                array('controller' => 'articlePages', 'action' => 'view', 'slug1' => $request['Article']['id'], 'slug2' => $request['Article']['slug'], 'slug3' => '1'),
                                array('title' => 'Aller à la page de la critique ' . $request['Article']['title'])
                            );
                        ?>
                      </span>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </section>

</section>
