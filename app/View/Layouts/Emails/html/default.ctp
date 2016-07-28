
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
            echo $this->Html->meta('viewport', 'width=device-width, initial-scale=1');
        ?>

        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>

        <style>
          body {
              font-family: 'Lato', sans-serif;
              min-height: 100%;
              position: relative;
              font-size: 16px;
          }
          .mail-header {
              width: 100%;
              position: relative;
          }
          .mail-header__logo {
              width: 500px;
              margin: 0 auto 30px;
          }
          .contact__informations {
              position: relative;
              width: 1000px;
          }
          .contact__informations:after{
              content:'';
              display:block;
              clear:both;
          }
          .contact__term {
              float: left;
              width: 200px;
              margin-bottom: 10px;
          }
          .contact__description {
              float: left;
              width: 775px;
              margin-left: 25px;
              margin-bottom: 20px;
          }
          .contact__description:after {
              content: '';
              display: block;
              width: 600px;
              position: absolute;
              padding-top: 10px;
              left: 0;
              border-bottom: 1px dotted #1E5F7D;
          }
        </style>
    </head>
    <body>
        <?php echo $this->element('mail-header'); ?>
        <?php echo $this->fetch('content'); ?>
    </body>
</html>
