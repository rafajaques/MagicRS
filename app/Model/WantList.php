<?php

App::uses('AuthComponent', 'Controller/Component');

class WantList extends AppModel {
    public $name = 'want_list';
	public $useTable = 'want_list';
	
    public $validate = array(
        'quantity' => array(
            'required' => array(
                'rule' => array('comparison', '>', '0'),
                'message' => 'Você deve especificar um número válido de cartas.',
            ),
        ),
	);
	
	public function getCards($id_user, $max = null, $lasts = null) {
		$filter = array(
			'conditions' => array(
				'WantList.id_user' => $id_user,
			),
			'joins' => array(
				array(
					'table' => 'cards',
					'alias' => 'Card',
					'type' => 'LEFT',
					'conditions' => array('Card.id = WantList.id_card'),
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
				'WantList.quantity',
				'WantList.note'
			),
		);
		
		if ($lasts)
			$filter['order'] = 'WantList.added DESC';
		
		if ($max)
			$filter['limit'] = $max;
		
		return $this->find('all', $filter);
	}

	public function wantCard($user, $card) {
		$out = $this->find('count', array(
			'conditions' => array(
				'id_user' => $user,'id_card' => $card
			),
		));
		
		return (bool) $out;
	}
	
	public function wantListCount($user) {
		$out = $this->find('count', array(
			'conditions' => array(
				'id_user' => $user,
			),
		));
		
		return $out;
	}
	
}