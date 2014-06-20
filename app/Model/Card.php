<?php
// app/Model/Card.php

App::uses('AuthComponent', 'Controller/Component');

class Card extends AppModel {
    public $name = 'cards';
	
	public $uses = array('Set');
	
	public function getCardByName($name) {
		$name = trim($name);
		return $this->find('first', array(
			'joins' => array(array(
				'table' => 'sets',
				'alias' => 'Set',
				'type' => 'LEFT',
				'conditions' => array('Card.id_set = Set.id'),
			)),
			'conditions' => array(
				'OR' => array(
					'Card.name' => $name,
					'Card.name_en' => $name,
				),
			),
			'fields' => array(
				'Card.id',
				'Card.id_set',
				'Card.name',
				'Card.name_en',
				'Card.mana_cost',
				'Card.colors',
				'Card.type',
				'Card.multiverseid',
				'Card.rarity',
				'Set.name as set_name',
			),
		));
	}
	
	public function suggest($str, $limit = 10) {
		$pt = $this->find('list', array(
			'conditions' => array(
				'Card.name like' => "%{$str}%",
			),
			'fields' => array('name'),
			'limit' => $limit,
			'group' => 'name',
		));
		$en = $this->find('list', array(
			'conditions' => array(
				'Card.name_en like' => "%{$str}%",
			),
			'fields' => array('name_en'),
			'limit' => $limit,
			'group' => 'name_en',
		));
		
		$out = array_merge($pt, $en);

		sort($out);
		
		return $out;
	}
}