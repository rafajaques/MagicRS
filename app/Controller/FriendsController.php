<?php

class FriendsController extends AppController {
	
	public $uses = array('UserFriend');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('title_for_layout', 'Amigos');
	}
	
	public function index() {
		$this->set('section_for_layout', 'Lista de amigos');

		$this->set('friends', $this->User->getFriends($this->Auth->user('id')));

		if (isset($this->request->data['search'])) {
			$words = explode(' ', $this->request->data['search']);
			
			$s_result = $this->User->find('all', array(
				'conditions' => array(
					'OR' => array(
						'User.name' => $words,
						'User.surname' => $words,
						'User.username' => $words,
					),
				),
				'joins' => array(array(
					'table' => 'cities',
					'alias' => 'City',
					'type' => 'LEFT',
					'conditions' => array('User.id_city = City.id'),
				)),
				'fields' => array(
					'User.id',
					'User.name',
					'User.surname',
					'User.username',
					'City.name as city_name',
				)
			));
			
			$this->set('s_result', $s_result);
		}
	}
	
	public function add($friend_id = null) {
		// Se não existe ID ou se quero ser meu próprio amigo
		if (!$friend_id || ($my_id = $this->Auth->user('id')) == $friend_id)
			$this->redirect('/');
		
		$UserFriend = &$this->UserFriend;

		$this->autoRender = false;
		
		// Já é amigo?
		if ($UserFriend->isFriend($my_id, $friend_id)) {
			$this->setFlash('Ocorreu um erro inesperado.', 'error');
			$this->redirect($this->referer());
		}
		
		// Verifica se existe um contra-pedido - aí vamos aceitar
		if ($UserFriend->hasRequested($friend_id, $my_id)) {
			$UserFriend->consolidate($my_id, $friend_id);
			$this->setFlash('Parabéns pela nova amizade! :)', 'success');
		}
		// Se já foi feita a requisição, vamos retirá-la
		elseif ($UserFriend->hasRequested($my_id, $friend_id)) {
			$UserFriend->removeRequest($my_id, $friend_id);
			$this->setFlash('Pedido de amizade cancelado.', 'success');
		}
		// Caso contrário, vamos criá-la!
		else {
			$UserFriend->addRequest($my_id, $friend_id);
			$this->setFlash('Pedido de amizade enviado com sucesso.', 'success');
		}

		$this->redirect($this->referer());
	}
	
}