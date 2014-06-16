<?php

App::uses('AuthComponent', 'Controller/Component');

class UserFriend extends AppModel {
	
	public $useTable = 'users_friends';
	
	public $uses = array('UserNotification', 'User');
	
	/**
	 * Retorna 'friend' para amigo, 'sent' para enviado
	 * 'received' para recebida e false para nada
	 */
	public function friendshipStatus($from, $to) {
		// Verifica se houve um contra-convite
		if ($this->hasRequested($to, $from))
			return 'received';
		
		$out = $this->find('first', array(
			'conditions' => array(
				'id_user' => $from,
				'id_friend' => $to,
			),
		));

		if (!count($out))
			return false;

		if ($out['UserFriend']['accepted'])
			return 'friend';
		else
			return 'sent';
	}
	
	/**
	 * Consolida a amizade entre dois usuários
	 */
	public function consolidate($id1, $id2) {
		// Consolida 1 -> 2 e depois 2 -> 1
		for ($i=1;$i<=2;$i++) {
			$t = $this->find('count', array(
				'conditions' => array(
					'id_user' => $id1,
					'id_friend' => $id2,
				),
			));
		
			// Já existe pedido
			if ($t) {
				$save = array(
					'since' => 'NOW()',
					'accepted' => 1,
				);
				
				$this->updateAll($save, array(
					'id_user' => $id1,
					'id_friend' => $id2
				));
			}
			// Não existe pedido
			else {
				$save = array(
					'id_user' => $id1,
					'id_friend' => $id2,
					'since' => date('Y-m-d H:i:s'),
					'accepted' => 1,
				);
			
				$this->save($save);
			}
			
			// Troca os IDs de lugar para repetir a rotina
			$idx = $id1;
			$id1 = $id2;
			$id2 = $idx;
		}

		return true;
	}
	
	public function isFriend($from, $to) {
		$out = $this->find('count', array(
			'conditions' => array(
				'id_user' => $from,
				'id_friend' => $to,
				'accepted' => 1,
			),
		));

		return (bool) $out;
	}
	
	public function hasRequested($from, $to) {
		$out = $this->find('count', array(
			'conditions' => array(
				'id_user' => $from,
				'id_friend' => $to,
				'accepted' => null,
			),
		));

		return (bool) $out;
	}
	
	public function addRequest($from, $to) {
		if ($this->hasRequested($from, $to))
			return false;
	
		// Gera uma notificação para o usuário
		$un = new UserNotification();
		$user = new User();
		
		$un->setNotification(
			$to,
			'friend',
			'Pedido de amizade de '.$user->getName($from, true),
			$from
		);
	
		// Prepara os dados pra salvar
		$save = array(
			'id_user' => $from,
			'id_friend' => $to,
			'since' => date('Y-m-d H:i:s'),
		);
		
		return $this->save($save);
	}
	
	public function removeRequest($from, $to) {
		if (!$this->hasRequested($from, $to))
			return false;
		
		$un = new UserNotification();
		$un->deleteNotification($to, $from);
		
		$delete = array(
			'id_user' => $from,
			'id_friend' => $to,
		);
		
		return $this->deleteAll($delete, false);
	}
	
	public function getFriendRequests($id_user) {
		
	}
	
}