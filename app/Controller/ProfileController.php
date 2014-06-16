<?php

class ProfileController extends AppController {
	var $uses = array('User', 'City', 'UserCard', 'WantList', 'UserFriend');

    public function beforeFilter() {
        parent::beforeFilter();

		$this->set('title_for_layout', 'Perfil');
    }
	
    public function index() {
		$this->redirect('/profile/view/'.$this->Auth->user('id'));
    }

    public function view($id = null) {
		$my_id = $this->Auth->user('id');
		
		// Rotinas específicas para meu próprio perfil
		if (!$id || $my_id == $id) {
			$this->set('section_for_layout', 'Meu perfil');
		
			$user = $this->Auth->user();
		
			// Define se o perfil sendo visualizado é o meu
			$this->set('is_mine', true);
		}
		// Rotinas específicas para visualização geral de perfis
		else {
			$this->set('section_for_layout', 'Visualizar perfil');
	        $this->User->id = $id;
			$this->set('is_mine', false);
			
			// Existe esse usuário?
			if (!$this->User->exists()) {
				$this->redirect('/');
			}
			
			$user = $this->User->find('first', array('conditions' => array('id' => $id)));
			$user = $user['User'];
			unset($user['password']);
			
			$this->set('friendship', $this->UserFriend->friendshipStatus($my_id, $id));
		}
		
		// Rotinas gerais de perfil
		$profile = $user;
		$profile['full_name'] = $user['name'].' '.$user['surname'];
		$profile['collec_count'] = $this->UserCard->count($user['id']);
		$profile['city'] = $this->City->getName($user['id_city']);
		
		$profile['avatar_path'] = $this->User->getAvatar($id);

		$profile['sample_cards'] = $this->UserCard->getSample($user['id']);
		
		// Busca da have list
		$profile['have_cards'] = $this->UserCard->getHaveLasts($user['id'], 5);
		
		// Busca da want list
		$profile['want_cards'] = $this->WantList->getCards($user['id'], 5, true /* lasts */);

		$this->set('profile', $profile);

    }
	
	public function cards($id = null) {
		if (!$id)
			$this->redirect('/');
		
		$this->set('section_for_layout', 'Visualizar cartas');
        $this->User->id = $id;
		$this->set('is_mine', false);
		
		// Existe esse usuário?
		if (!$this->User->exists()) {
			$this->redirect('/');
		}
		
		$profile = $this->User->find('first', array('conditions' => array('id' => $id)));
		$profile = $profile['User'];
		$profile['full_name'] = $profile['name'].' '.$profile['surname'];
		$profile['city'] = $this->City->getName($profile['id_city']);

		$profile['sample_cards'] = $this->UserCard->getSample($profile['id']);
		
		$this->set('profile', $profile);
		$this->set('card_list', $this->UserCard->getCards($profile['id']));
			
		$user = $this->User->find('first', array('conditions' => array('id' => $id)));
		$user = $user['User'];
		unset($user['password']);
		
		//$this->set('')
	}

	public function have($id = null) {
		if (!$id)
			$this->redirect('/');
		
		$this->set('section_for_layout', 'Have list');
		
		$profile = $this->User->find('first', array('conditions' => array('id' => $id)));
		$profile['User']['full_name'] = $profile['User']['name'].' '.$profile['User']['surname'];
		$this->set('profile', $profile['User']);
		
		$this->set('card_list', $this->UserCard->getHaveLasts($id, false));
	}
	
	public function want($id = null) {
		if (!$id)
			$this->redirect('/');
		
		$this->set('section_for_layout', 'Want list');
		
		$profile = $this->User->find('first', array('conditions' => array('id' => $id)));
		$profile['User']['full_name'] = $profile['User']['name'].' '.$profile['User']['surname'];
		$this->set('profile', $profile['User']);
		
		$this->set('card_list', $this->WantList->getCards($id));
	}

}