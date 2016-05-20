
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

            echo $this->Html->css('main');
        ?>
    </head>
    <body>
        <?php echo $this->element('mail-header'); ?>
        <?php echo $this->fetch('content'); ?>
    </body>
</html>
