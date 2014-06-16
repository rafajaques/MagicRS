<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'pages', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'index')
		)
	);
	
	public $uses = array(
		'User',
		'UserNotification',
	);

	function beforeFilter() {
		// Se temos um usuário autenticado...
		if ($user = $this->Auth->user()) {
			$this->set('user', $user);
			$this->set('avatar', $this->User->getAvatar($user['id']));
		}
		
		$this->set('logedin', (bool) $user);
		$this->set('projectName', 'Magic RS');
		
		$un = &$this->UserNotification;
		
		// Verifica se tem alguma notificação pra marcar como lida
		if (isset($this->request->query['n'])) {
			$n = intval($this->request->query['n']);
			$un->readNotification($n, $user['id']);
		}
		
		// Notificações
		$this->set('notify', $un->getAll($user['id']));
		$this->set('notify_count', $un->getUnreadCount($user['id']));
	}
	
	public function setFlash($msg, $type) {
		return $this->Session->setFlash($msg, 'default', array(), $type);
	}
}
