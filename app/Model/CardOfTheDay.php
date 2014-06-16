<?php

App::uses('AuthComponent', 'Controller/Component');
App::import('model', 'Card');

// COD = Card Of the Day

class CardOfTheDay extends AppModel {
    public $name = 'card_of_the_day';
	public $useTable = 'card_of_the_day';
	
    public function getCard() {
    	
		$today = date('Y-m-d');
		
		$out = $this->find('first', array(
			'conditions' => array('day' => $today),
			'joins' => array(
				array(
					'table' => 'cards',
					'alias' => 'Card',
					'type' => 'LEFT',
					'conditions' => array('CardOfTheDay.id_card = Card.id'),
				),
				array(
					'table' => 'sets',
					'alias' => 'Set',
					'type' => 'LEFT',
					'conditions' => array('Card.id_set = Set.id'),
				),
			),
			'fields' => array(
				'Card.id',
				'Card.name',
				'Card.name_en',
				'Card.multiverseid',
				'Set.name as set_name',
				'Set.code as code',
				'Set.release'
			),
			'limit' => 1,
		));
		
		if (!count($out)) {
			$this->Card = new Card();
			
			$new_cod = $this->Card->find('first', array(
				'conditions' => 'CardOfTheDay.day IS NULL',
				'joins' => array(
					array(
						'table' => 'card_of_the_day',
						'alias' => 'CardOfTheDay',
						'type' => 'LEFT',
						'conditions' => array('CardOfTheDay.id_card = cards.id'),
					),
				),
				'order' => 'RAND()',
				'fields' => 'cards.id',
			));
			$save = array('CardOfTheDay' => array(
				'id_card' => $new_cod['cards']['id'],
				'day' => $today,
			));
			
			$this->save($save);
			
			// Busca novamente
			return $this->getCard();
		}
		
		return $out;
		
    }
	
}