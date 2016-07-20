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

<html lang="fr">
    <head>
        <?php
            echo $this->Html->charset();
            echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));
        ?>
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title><?php echo ($this->fetch('title') . ' - YouthBook.be'); ?></title>

        <?php
            echo $this->Html->meta('description', $this->fetch('description'));
            echo $this->Html->meta(array('name' => 'author', 'content' => 'Julien Laurent'));
        ?>

        <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/img/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/img/favicon/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/img/favicon/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/img/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/img/favicon/manifest.json">
        <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#1e5f7d">
        <link rel="shortcut icon" href="/img/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#1e5f7d">
        <meta name="msapplication-TileImage" content="/img/favicon/mstile-144x144.png">
        <meta name="msapplication-config" content="/img/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">

        <?php

            echo $this->Html->css('main');

            echo $this->Html->script('modernizr-2.8.3.min');

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');

        ?>
    </head>
    <body>

        <h1 class='hidden'>YouthBook.be - Site d’actualité et de critiques communautaire sur la littérature jeunesse</h1>

        <?php echo $this->element('connect-box'); ?>
        <?php echo $this->element('confirm-box'); ?>

        <?php echo $this->element('header'); ?>

        <div class='content'>

            <div class='content__container clearfix'>

                <?php echo $this->fetch('content'); ?>

            </div>

        </div>

        <?php echo $this->element('footer'); ?>

        <?php echo $this->Html->script('jquery-2.1.4.min.js'); ?>
        <?php echo $this->Html->script('main.js'); ?>

    </body>
</html>
