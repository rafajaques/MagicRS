<?php

App::uses('AppController', 'Controller');

class CardsController extends AppController {
	public $uses = array('Card', 'Set', 'UserCard', 'WantList', 'Report');
	public $helpers = array('Mtg', 'List');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'ajax', 'report');
		$this->set('title_for_layout', __('Enciclopédia de Cartas'));
	}

	public function index() {
		// Envia o nome da seção atual
		$this->set('section_for_layout', __('Principal'));

		// Busca todas as coleções
		$this->set('sets', $this->Set->find('list', array('order' => 'release DESC')));
		
		if ($this->request->is('post') && $this->request->data) {
			if (isset($this->request->data['quick'])) {
				
				$quick_string = $this->request->data['quicksearch'];
				// Se veio da busca rápida, verifica se existe apenas
				// uma correspondência.
				// Caso exista mais de uma, realiza uma busca e
				// mostra todos os resultados
				$unique_id = $this->Card->find('all', array(
					'conditions' => array(
						'OR' => array(
							'Card.name LIKE' => "%{$quick_string}%",
							'Card.name_en LIKE' => "%{$quick_string}%",
						),
					),
					'fields' => 'id',
				));
				
				// Deu certo! Apenas uma carta! :)
				if (count($unique_id) == 1) {
					$this->redirect('/cards/view/'.$unique_id[0]['Card']['id']);
				}
				
				// Caso não tenha redirecionado, planta o valor da busca aqui
				$this->request->data['text'] = $quick_string;
			}

			// Faz a busca das cartas
			$filter = array(
				'limit' => 100, #período de testes
				'conditions' => array(
					'OR' => array(
						'Card.name like' => "%{$this->request->data['text']}%",
						'Card.name_en like' => "%{$this->request->data['text']}%",
					),
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
					'Set.code as code',
					'Set.release'
				),
				'order' => 'Card.name ASC',
			);

			// Refina o filtro
			if ($id_set = $this->request->data('set'))
				$filter['conditions']['Card.id_set'] = $id_set;
			
			if ($this->request->data('all_mana') && $this->request->data('colors'))
				foreach ($this->request->data('colors') as $c_filter)
					$filter['conditions'][] = 'FIND_IN_SET(\''.$c_filter.'\', Card.colors)';
			elseif ($c_filter = $this->request->data('colors'))
				$filter['conditions']['Card.colors'] = $c_filter;
			
			// Verifica se temos que pesquisar nas have lists
			if (isset($this->request->data['have'])) {
				$this->set('sHave', ' checked="checked"');
				$filter['joins'][] = array(
					'table' => 'users_cards',
					'alias' => 'UserCard',
					'type' => 'LEFT',
					'conditions' => array('UserCard.id_card = Card.id'),
				);
				$filter['conditions']['UserCard.have_list'] = 1;
			}
			
			// Checkboxes - selecionadas
			if ($this->request->data('colors'))
				foreach ($this->request->data('colors') as $color)
					$this->set('s'.ucfirst($color), 'checked="checked"');
			
			$cards = $this->Card->find('all', $filter);
			$this->set('card_list', $cards);
		}
	}
	
	public function view() {
		// Envia o nome da seção atual
		$this->set('section_for_layout', __('Visualizar carta'));
		
		// Verifica se existe carta para ser visualziada
		if (!$card_id = $this->request->param('card_id')) {
			$this->response->header('location', '/cards');
			die;
		}
		
		// Busca a carta
		$card = $this->Card->find('first', array(
			'conditions' => array(
				'Card.id' => $card_id,
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
		
		$this->set('card', $card['Card']);
		$this->set('set', $card['Set']);
		
		// Adiciona o nome da carta no título da página
		$this->set('title_for_layout', $card['Card']['name']);
		
		// Puxa a lista de haves
		$this->set('haves', $this->UserCard->getHavesByName($card['Card']['name'], $this->Auth->user('id')));
		
		// Verifica se o usuário está autenticado
		if ($user_id = $this->Auth->user('id')) {
			// Verifica se o usuário tem essa carta
			$this->set('hasCard', $this->UserCard->hasCard($user_id, $card_id));
			$this->set('wantCard', $this->WantList->wantCard($user_id, $card_id));
		}
		
		// Busca o preço da carta
		$price_url = 'http://magictcgprices.appspot.com/api/tcgplayer/price.json?cardname='.rawurlencode($card['Card']['name_en']);
		//.'&cardset='.rawurlencode($card['Set']['set_name_en']);
		if ($price = file_get_contents($price_url)) {
			$price = json_decode($price);
			$avg_price = substr($price[0], 1) + substr($price[1], 1) + substr($price[2], 1);
		} else {
			$avg_price = NULL;
		}
		$this->set('avg_price', $avg_price);
	}
	
	public function ajax() {
		$this->autoRender = false;

		if (isset($this->request->query['query'])) {
			$q = $this->request->query['query'];
			
			// Prepara a resposta ajax, devolvendo a consulta e as sugestões
			$out = array(
				'query' => $q,
				'suggestions' => $this->Card->suggest($q),
			);
			
			echo json_encode($out);
		}
	}
	
	public function report() {
		$this->autoRender = false;
		
		if (!count($this->request->data))
			$this->redirect('/');

		$data = $this->request->data;

		$save = array(
			'id_card' => $data['id_card'],
			'date' => date('Y-m-d H:i:s'),
			'other' => $data['outro'],
			'id_user' => $this->Auth->user('id'), /* só se estiver logado */
		);
		
		unset($data['id_card'], $data['outro']);
		
		$errors = array();
		
		foreach ($data as $k => $v)
			if ($v)
				$errors[] = $k;
		
		$save['errors'] = implode(',', $errors);
		
		$this->Report->save($save);
		
		$this->setFlash('Obrigado por enviar sua notificação!', 'success');
		
		$this->redirect($this->referer());
	}
}
