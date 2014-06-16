<?php

App::uses('AppController', 'Controller');

/**
 * Gerencia todas as páginas básicas
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('CardOfTheDay');
	public $helpers = array('Mtg');
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
		$this->set('title_for_layout', __('Página Inicial'));
		$this->set('section_for_layout', '');
	}

	public function index() {

		// Carta do dia (cod = card of the day)
		$this->set('cod', $this->CardOfTheDay->getCard());

	}
}
