<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'dynamicPages', 'action' => 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

  Router::connect('books/index/:slug', array('controller' => 'books', 'action' => 'index'));
  Router::connect('books/view/:slug', array('controller' => 'books', 'action' => 'view'));
	Router::connect('books/articles/:slug1/:slug2', array('controller' => 'books', 'action' => 'articles'));
  Router::connect('books/edit/:slug', array('controller' => 'books', 'action' => 'edit'));

	Router::connect('articles/index/:slug', array('controller' => 'articles', 'action' => 'index'));
	Router::connect('articles/edit/:slug1/:slug2', array('controller' => 'articles', 'action' => 'edit'));

	Router::connect('articlePages/view/:slug1/:slug2/:slug3', array('controller' => 'articlePages', 'action' => 'view'));

	Router::connect('sagas/view/:slug', array('controller' => 'sagas', 'action' => 'view'));
	Router::connect('sagas/edit/:slug', array('controller' => 'sagas', 'action' => 'edit'));

	Router::connect('users/collection', array('controller' => 'users', 'action' => 'index'));
	Router::connect('users/newPassword/:slug1/:slug2', array('controller' => 'users', 'action' => 'newPassword'));

	Router::connect('comments/index/:slug1/:slug2', array('controller' => 'comments', 'action' => 'index'));

	Router::connect('conversations/view/:slug', array('controller' => 'conversations', 'action' => 'view'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
