<?php
// app/Model/Card.php

App::uses('AuthComponent', 'Controller/Component');

class Card extends AppModel {
    public $name = 'cards';
	
	public $uses = array('Set');
	
	public function getCard($id) {
		return $this->find('first', array(
			'conditions' => array(
				'Card.id' => $id,
			),
			'joins' => array(array(
				'table' => 'sets',
				'alias' => 'Set',
				'type' => 'LEFT',
				'conditions' => array('Card.id_set = Set.id'),
			)),
			'fields' => array(
				'Card.*',
				'Set.name as set_name',
				'Set.name_en as set_name_en',
				'Set.code as code',
				'Set.release',
			),
		));
	}
	
	public function getReprints($id) {
		$name = $this->find('first', array(
			'conditions' => array(
				'Card.id' => $id,
			),
			'fields' => 'name_en',
		));
		
		if (!isset($name['Card']['name_en']))
			return false;
		
		return $this->find('all', array(
			'conditions' => array(
				'Card.id !=' => $id,
				'Card.name_en' => $name['Card']['name_en'],
			),
			'joins' => array(array(
				'table' => 'sets',
				'alias' => 'Set',
				'type' => 'LEFT',
				'conditions' => array('Card.id_set = Set.id'),
			)),
			'fields' => array(
				'Card.id',
				'Set.name as set_name',
				'Set.code as code',
			),
			'order' => 'release DESC',
		));
	}
	
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