<?php
// app/Model/City.php

App::uses('AuthComponent', 'Controller/Component');

class City extends AppModel {
    public $name = 'City';
	
	public function getName($id) {
		$name = $this->find('first', array(
			'conditions' => array('id' => $id),
			'fields' => array('name'),
		));
		
		return $name['City']['name'];
	}
}