<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = __d('cake_dev', $pageName . ' - YouthBook.be');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html>

<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            <?php echo ($this->fetch('title') . ' - YouthBook.be'); ?>
        </title>
        <?php

            echo $this->html->meta('favicon.ico', 'img/favicon.ico', array('type' => 'icon'));

            echo $this->Html->meta('description', $this->fetch('description'));
            echo $this->Html->meta('viewport', 'width=device-width, initial-scale=1');

            echo $this->Html->css('main');

            echo $this->Html->script('modernizr-2.8.3.min');

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
        ?>
    </head>
    <body>

        <h1 class='hidden'>YouthBook.be - Site d’actualité communautaire sur la littérature jeunesse</h1>

        <?php echo $this->element('connect-box'); ?>
        <?php echo $this->element('confirm-box'); ?>

        <?php echo $this->element('header'); ?>

        <div class='content'>

            <div class='content__container clearfix'>

                <?php echo $this->fetch('content'); ?>

            </div>

        </div>

        <?php echo $this->element('footer'); ?>

        <?php
            if ($this->params['controller'] == 'articlePages' && $this->params['action'] == 'view') {
                echo $this->element('comment');
            }
        ?>

        <?php echo $this->Html->script('jquery-2.1.4.min.js'); ?>
        <?php echo $this->Html->script('main.js'); ?>

    </body>
</html>
