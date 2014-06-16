<?php

App::uses('AuthComponent', 'Controller/Component');

class UserNotification extends AppModel {
    public $useTable = 'users_notifications';

	public function getAll($id_user) {
		return $this->find('all', array(
			'conditions' => array('id_user' => $id_user),
			'order' => 'when DESC',
		));
	}
	
	public function getUnreadCount($id_user) {
		return $this->find('count', array(
			'conditions' => array('id_user' => $id_user, 'read !=' => 1),
		));
	}
	
	public function readNotification($id_notif, $id_user) {
		// id_user é importante aqui para assegurar que ninguém apague
		// notificações de outros
		
		return $this->updateAll(
			array(
				'read' => 1,
			),
			array(
				'id' => $id_notif,
				'id_user' => $id_user,
			)
		);
	}
	
	public function setNotification($id_user, $type, $text, $id_related = null) {
		$save = array(
			'id_user' => $id_user,
			'type' => $type,
			'text' => $text,
			'id_related' => $id_related,
			'when' => date('Y-m-d H:i:s'),
			'read' => 0,
		);
		
		return $this->save($save);
	}
	
	/**
	 * Apenas usado em caso de remover notificação de amizade
	 * 1 = id_user
	 * 2 = id_user; id_related
	 */
	public function deleteNotification() {
		if (func_num_args() == 1)
			return $this->delete(func_get_arg(0));
		elseif (func_num_args() > 1)
			return $this->deleteAll(array('id_user' => func_get_arg(0), 'id_related' => func_get_arg(1)), false);
		else
			return false;
	}
	
}