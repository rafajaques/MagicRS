<?php

App::uses('AuthComponent', 'Controller/Component');

class UserCard extends AppModel {
    public $name = 'users_cards';
	
    public $validate = array(
        'quantity' => array(
            'required' => array(
                'rule' => array('comparison', '>', '0'),
                'message' => 'Você deve especificar um número válido de cartas.',
            ),
        ),
	);
	
	public function hasCard($user, $card) {
		$out = $this->find('count', array(
			'conditions' => array(
				'id_user' => $user,
				'id_card' => $card,
			),
		));
		
		return (bool) $out;
	}
	
	public function haveListCount($user) {
		$out = $this->find('count', array(
			'conditions' => array(
				'id_user' => $user,
				'have_list' => 1,
			),
		));
		
		return $out;
	}
	
	public function count($user) {
		$out = $this->find('count', array(
			'conditions' => array(
				'id_user' => $user,
			),
		));
		
		return $out;
	}
	
	/**
	 * Retorna uma amostragem aleatória de cartas de um usuário
	 */
	public function getSample($id_user, $max = 3) {
		$out = $this->find('all', array(
			'conditions' => array(
				'UserCard.id_user' => $id_user,
			),
			'joins' => array(array(
				'table' => 'cards',
				'alias' => 'Card',
				'type' => 'LEFT',
				'conditions' => array('Card.id = UserCard.id_card'),
			)),
			'limit' => $max,
			'order' => 'RAND()',
			'fields' => array(
				'Card.id',
				'Card.name',
				'Card.multiverseid',
			),
		));
		
		return $out;
	}
	
	/**
	 * Retorna uma amostragem das últimas cartas adicionadas à have do usuário
	 */
	public function getHaveLasts($id_user, $max = false) {
		$out = $this->find('all', array(
			'conditions' => array(
				'UserCard.id_user' => $id_user,
				'UserCard.have_list' => 1,
			),
			'joins' => array(
				array(
					'table' => 'cards',
					'alias' => 'Card',
					'type' => 'LEFT',
					'conditions' => array('Card.id = UserCard.id_card'),
				),
				array(
					'table' => 'sets',
					'alias' => 'Set',
					'type' => 'LEFT',
					'conditions' => array('Card.id_set = Set.id'),
				),
			),
			'limit' => $max,
			'order' => 'added DESC',
			'fields' => array(
				'Card.id',
				'Card.name',
				'Card.name_en',
				'Card.mana_cost',
				'Card.cmc',
				'Card.rarity',
				'Card.multiverseid',
				'UserCard.quantity',
				'Set.name as set_name',
				'Set.code'
			),
		));
		
		return $out;
	}
	
	public function getCards($id_user, $max = null) {
		$filter = array(
			'conditions' => array(
				'UserCard.id_user' => $id_user,
			),
			'joins' => array(
				array(
					'table' => 'cards',
					'alias' => 'Card',
					'type' => 'LEFT',
					'conditions' => array('Card.id = UserCard.id_card'),
				),
				array(
					'table' => 'sets',
					'alias' => 'Set',
					'type' => 'LEFT',
					'conditions' => array('Card.id_set = Set.id'),
				),
			),
			'limit' => $max,
			'order' => 'Card.name',
			'fields' => array(
				'Card.id',
				'Card.id_set',
				'Card.name',
				'Card.name_en',
				'Card.mana_cost',
				'Card.cmc',
				'Card.text',
				'Card.type',
				'Card.multiverseid',
				'Card.rarity',
				'Set.name as set_name',
				'Set.code',
			),
		);
		
		if ($max)
			$filter['limit'] = $max;
		
		return $this->find('all', $filter);
	}
	
	/**
	 * Retorna uma lista com todas as pessoas que tem a carta
	 */
	public function getHaves($id_card) {
		
	}
	
	/**
	 * Retorna uma pelo nome da carta
	 */
	public function getHavesByName($card_name, $my_id) {
		$card_name = addslashes($card_name);
		$my_id = intval($my_id);

		return $this->find('all', array(
			'fields' => array(
				'UserCard.id_user', 'UserCard.id_card', 'UserCard.quantity',
				'CONCAT(User.name, " ", User.surname) AS full_name',
				'User.username', 'City.name AS city_name', 'Set.code AS set_code',
			),
			'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'LEFT',
					'conditions' => array('UserCard.id_user = User.id'),
				),
				array(
					'table' => 'cards',
					'alias' => 'Card',
					'type' => 'LEFT',
					'conditions' => array('UserCard.id_card = Card.id'),
				),
				array(
					'table' => 'cities',
					'alias' => 'City',
					'type' => 'LEFT',
					'conditions' => array('City.id = User.id_city'),
				),
				array(
					'table' => 'sets',
					'alias' => 'Set',
					'type' => 'LEFT',
					'conditions' => array('Set.id = Card.id_set'),
				),
			),
			'conditions' => array(
				'UserCard.have_list' => 1,
				'User.active' => 1,
				'Card.name' => $card_name,
				'User.id !=' => $my_id,
			),
			'order' => array(
				'City.name ASC',
				'Set.release DESC',
			),
		));
		#return $this->query('SELECT uc.id_user, uc.id_card, uc.quantity, CONCAT(u.name, " ", u.surname) AS full_name, u.username, u.avatar, ci.name AS city_name FROM users_cards uc LEFT JOIN users u ON (uc.id_user = u.id) LEFT JOIN cards c ON (uc.id_card = c.id) LEFT JOIN cities ci ON (ci.id = u.id_city) WHERE uc.have_list = 1 AND u.active = 1 AND c.name = "'.$card_name.'" AND u.id != "'.$my_id.'" ORDER BY city_name ASC, s.release');
	}
	
}