<?php

App::uses('AppController', 'Controller');

class FacebookController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'auth');
	}
	
	public function index() {
		$this->set('section_for_layout', 'Facebook');

		// Logado no facebook?
		if ($fbToken = $this->Session->read('fbToken')) {
			require('../Facebook/StartFacebook.php');
			$session = new Facebook\FacebookSession($fbToken);
			$request = new Facebook\FacebookRequest($session, 'GET', '/me');
			$response = $request->execute();
			$go = $response->getGraphObject()->asArray();
			$fbId = $go['id'];
		}
		
		// Verifica se a conta está linkada ao facebook
		$is_linked = $this->User->isFacebookLinked($this->Auth->user('id'));
		$this->set('is_linked', $is_linked);
		
		
		// Verifica se tem permissão de acessar os amigos
		if ($this->User->isFacebookFriendsAuth($this->Auth->user('id'))) {
			$this->set('friends_permission_ok', true);
		}
		// Se ainda não tem permissão, solicitamos
		elseif ($is_linked) {
			$helper = new Facebook\FacebookRedirectLoginHelper(Router::url('/facebook/authFriends', true));
			$this->set('friends_permission_link', $helper->getLoginUrl(array('user_friends')));
		}
		
	}
	
	/**
	 * Vincular a conta com o facebook
	 */
	public function login() {
		require('../Facebook/StartFacebook.php');
		
		$helper = new Facebook\FacebookRedirectLoginHelper(Router::url('/facebook/auth', true));
		$loginUrl = $helper->getLoginUrl();
		$this->redirect($loginUrl);
	}
	
	/**
	 * Retorna após autenticar
	 */
	public function auth() {
		require('../Facebook/StartFacebook.php');

		$helper = new Facebook\FacebookRedirectLoginHelper(Router::url('/facebook/auth', true));

		try {
			$session = $helper->getSessionFromRedirect();
		} catch(FacebookRequestException $ex) {
			// When Facebook returns an error
		} catch(\Exception $ex) {
			// When validation fails or other local issues
		}
		if ($session) {
			$this->Session->write('fbToken', $session->getToken());
		
			$session = new Facebook\FacebookSession($session->getToken());
			$request = new Facebook\FacebookRequest($session, 'GET', '/me');
			$response = $request->execute();
			$graphObject = $response->getGraphObject()->asArray();
		
			$fb_id = $graphObject['id'];
			
			$user = $this->User->findByFb_id($fb_id);

			if ($user) {
				$this->Auth->login($user['User']);
				$this->redirect('/');
			} else {
				$this->setFlash('Oooops! Parece que sua conta não está vinculada ao Facebook. Autentique-se primeiro e vincule sua conta.', 'info');
				$this->redirect('/facebook');
			}
		}
	}
	
	/**
	 * Vincular a conta com o facebook
	 */
	public function link() {
		// Verifica se a conta já está vinculada
		if ($this->User->isFacebookLinked($this->Auth->user('id'))) {
			$this->setFlash('Sua conta já está vinculada com o Facebook.', 'info');
			$this->redirect('/facebook');
		}
		
		require('../Facebook/StartFacebook.php');
		
		$helper = new Facebook\FacebookRedirectLoginHelper(Router::url('/facebook/land', true));
		$loginUrl = $helper->getLoginUrl();
		$this->redirect($loginUrl);
	}
	
	/**
	 * Grava os dados do link
	 */
	public function land() {
		require('../Facebook/StartFacebook.php');

		$helper = new Facebook\FacebookRedirectLoginHelper(Router::url('/facebook/land', true));

		try {
			$session = $helper->getSessionFromRedirect();
		} catch(FacebookRequestException $ex) {
			// When Facebook returns an error
		} catch(\Exception $ex) {
			// When validation fails or other local issues
		}
		if ($session) {
			$this->Session->write('fbToken', $session->getToken());
			
			$session = new Facebook\FacebookSession($session->getToken());
			$request = new Facebook\FacebookRequest($session, 'GET', '/me');
			$response = $request->execute();
			$graphObject = $response->getGraphObject()->asArray();
			
			$this->User->linkFacebook($this->Auth->user('id'), $graphObject['id']);
			
			$this->setFlash('Sua conta foi vinculada ao Facebook com sucesso.', 'success');
			$this->redirect('/facebook');
		} else {
			$this->setFlash('Ocorreu um erro inesperado.', 'error');
			$this->redirect('/facebook');
		}
	}
	
	public function authFriends() {
		require('../Facebook/StartFacebook.php');

		$helper = new Facebook\FacebookRedirectLoginHelper(Router::url('/facebook/authFriends', true));

		try {
			$session = $helper->getSessionFromRedirect();
		} catch(FacebookRequestException $ex) {
			// When Facebook returns an error
		} catch(\Exception $ex) {
			// When validation fails or other local issues
		}
		if ($session) {
			$this->Session->write('fbToken', $session->getToken());
			
			$this->User->authFacebookFriends($this->Auth->user('id'));
			
			$this->setFlash('Permissão concedida com sucesso.', 'success');
			$this->redirect('/facebook');
		} else {
			$this->setFlash('Ocorreu um erro inesperado.', 'error');
			$this->redirect('/facebook');
		}
	}
	
	
}