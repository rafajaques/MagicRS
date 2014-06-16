<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    public $name = 'User';
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'É necessário digitar seu nome'
            )
        ),
        'surname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'É necessário digitar seu sobrenome'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'E-mail inválido'
            ),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'E-mail já registrado'
			),
        ),
		'username' => array(
		    'required' => array(
		        'rule' => 'notEmpty',
		        'message' => 'É necessário escolher um nome de usuário'
		    ),
		    'length' => array(
		        'rule' => array('minLength', 3),
		        'message' => 'Pelo menos 3 caracteres'
		    ),
		    'unique' => array(
		        'rule' => 'isUnique',
		        'message' => 'Nome de usuário já registrado'
		    ),
			'simplechars' => array(
				'rule' => '/^[a-z0-9_\.\-]{3,}$/i',
				'message' => 'Apenas caracteres simples, números, underline ( _ ), hífen ( - ) e ponto ( . )'
			),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'É necessária escolher uma senha',
            )
        ),
        'id_city' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Escolha uma cidade',
				// @TODO implementar escolha na lista das cidades disponíveis
            )
        ),
    );
	
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}
	
	public function getName($id_user, $full = false) {
		$out = $this->find('first', array(
			'conditions' => array('id' => intval($id_user)),
			'fields' => array('name', 'surname'),
		));
		
		if ($full)
			return $out['User']['name'].' '.$out['User']['surname'];
		else
			return $out['User']['name'];
	}
	
	public function getAvatar($id_user) {
		$img = $this->find('first', array(
			'conditions' => array('id' => intval($id_user)),
			'fields' => 'avatar',
		));
		
		if ($out = $img['User']['avatar'])
			return '/img/avatar/'.$out;
		else
			return '/img/no-avatar.jpg';
	}
	
	public function setAvatar($id_user, $file) {
		$this->id = $id_user;
		$this->saveField('avatar', $file);
		return true;
	}
	
	public function getFriends($id_user) {
		// SELECT * FROM users left join users_friends uf on (users.id = uf.id_friend) WHERE uf.id_user = 1 AND uf.accepted = 1
		return $this->find('all', array(
			'joins' => array(
				array(
					'table' => 'users_friends',
					'alias' => 'Friend',
					'type' => 'LEFT',
					'conditions' => array('User.id = Friend.id_friend'),
				),
				array(
					'table' => 'cities',
					'alias' => 'City',
					'type' => 'LEFT',
					'conditions' => array('City.id = User.id_city'),
				),
			),
			'conditions' => array(
				'Friend.id_user' => $id_user,
				'Friend.accepted' => 1,
			),
			'fields' => array(
				'User.*',
				'City.name as city_name',
			),
		));
	}
}