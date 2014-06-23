<?php

App::uses('AppController', 'Controller');

class SettingsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->set('title_for_layout', 'Preferências');
		
		$this->Auth->allow('index');
	}
	
	public function index() {
		$this->set('section_for_layout', 'Ajuste suas preferências');
	}
}