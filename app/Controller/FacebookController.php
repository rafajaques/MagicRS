<?php

App::uses('AppController', 'Controller');

class FacebookController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
	public function index() {
		
	}
	
}