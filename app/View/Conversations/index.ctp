<?php

    $this->assign('title', 'Conversations');
    $this->assign('description', 'Mes conversations');

?>

<?php echo $this->element('conversation-nav'); ?>

<section class='right-part'>

    <div class='page-title'><h2 class='beta page-title__item'>Mes conversations</h2></div>

    <div class='bloc bloc--padding'>

        <?php if( !empty($conversations) ): ?>

            <table class='table requests'>
                <caption class='hidden'>Liste de mes conversations</caption>
                <tr class='table__row'>
                    <th class='table__head table__head--book-title'>Nom de la conversation</th>
                    <th class='table__head'>Interlocuteurs</th>
                    <th class='table__head'>Dernier message</th>
                </tr>
                <?php foreach( $conversations as $conversation ): ?>
                    <tr class='table__row table__row--data table__row--conversation'>
                        <td class='table__data' data-head='Titre'>
                            <?php echo $this->Html->link(
                                $conversation['Conversation']['title'],
                                array('controller' => 'conversations', 'action' => 'view', 'slug' => $conversation['Conversation']['id']),
                                array('title' => 'Aller à la conversation' . $conversation['Conversation']['title'], 'class' => 'link'));
                            ?>
                        </td>
                        <td class='table__data' data-head='Interlocuteurs'>
                            <?php
                                $j = 0;
                                for( $i = 0 ; $i < count($conversation['User']) ; $i++ ) {
                                    if( $conversation['User'][$i]['username'] != $this->Session->read('Auth.User.username') ) {
                                        if( $j == 0 ) {
                                            echo $conversation['User'][$i]['username'];
                                        }
                                        else {
                                            echo ', ' . $conversation['User'][$i]['username'];
                                        }
                                        $j++;
                                    }
                                }
                            ?>
                        </td>
                        <td class='table__data' data-head='Dernier message'><?php echo $this->Time->format('d/m/Y G:H:s', $conversation['Conversation']['modified']) ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>

          <?php else: ?>

              <p>Vous n’avez aucune conversation.</p>

          <?php endif; ?>

    </div>

</section>
