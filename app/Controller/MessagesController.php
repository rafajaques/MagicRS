<?php

class MessagesController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('title_for_layout', 'Mensagens');
	}
	
	public function index() {
		$this->set('section_for_layout', 'Principal');
	}
	
}