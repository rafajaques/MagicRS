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
		$sets = $this->Set->getAll();

		$this->set('sets', $sets);
		
		if ($this->request->is('post') && $this->request->data) {
			// Caso não tenha redirecionado, planta o valor da busca aqui
			if (isset($this->request->data['quick']))
				$this->request->data['text'] = $this->request->data['quicksearch'];

			// Faz a busca das cartas
			$filter = array(
				'limit' => 200, #período de testes
				'conditions' => array(
					'OR' => array(
						'Card.name like' => "%{$this->request->data['text']}%",
						'Card.name_en like' => "%{$this->request->data['text']}%",
					),
				),
				'joins' => array(
					array(
						'table' => 'sets',
						'alias' => 'Set',
						'type' => 'LEFT',
						'conditions' => array('Card.id_set = Set.id'),
					),
					// Pegar sempre a coleção mais recente
					'LEFT JOIN (SELECT `InSet`.`id`, MAX(`InSet`.`release`) `release` FROM `sets` AS `InSet` GROUP BY `InSet`.`id`) AS `t2` ON `Set`.`id` = `t2`.`id` AND `Set`.`release` = `t2`.`release`',
				),
				'fields' => array(
					'Card.*',
					'COUNT(Card.name_en) as `sets_qtd`',
					'GROUP_CONCAT(Set.code, \',\', Set.name ORDER BY Set.release DESC SEPARATOR \';\') as multi_codes',
					'Set.name as set_name',
					'Set.code as code',
					'Set.release'
				),
				'order' => array(
					'Card.name ASC',
					'Set.release DESC',
				),
				'group' => 'Card.name_en',
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
			
			if (count($cards) == 1)
				$this->redirect('/cards/view/'.$cards[0]['Card']['id']);
			
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
		$card = $this->Card->getCard($card_id);
		
		$this->set('card', $card['Card']);
		$this->set('set', $card['Set']);
		
		// Busca as reimpressões
		$this->set('reprints', $this->Card->getReprints($card_id));
		
		// Adiciona o nome da carta no título da página
		$this->set('title_for_layout', $card['Card']['name']);
		
		// Puxa a lista de haves
		$this->set('haves', $this->UserCard->getHavesByName($card['Card']['name_en'], $this->Auth->user('id')));
		
		// Verifica se o usuário está autenticado
		if ($user_id = $this->Auth->user('id')) {
			// Verifica se o usuário tem essa carta
			$this->set('hasCard', $this->UserCard->hasCard($user_id, $card_id));
			$this->set('wantCard', $this->WantList->wantCard($user_id, $card_id));
		}
		
		// Busca o preço da carta
		$price_url = 'http://magictcgprices.appspot.com/api/tcgplayer/price.json?cardname='.rawurlencode($card['Card']['name_en']).'&cardset='.rawurlencode($card['Set']['set_name_en']);
		// try & catch couldn't help it :(
		@$price = file_get_contents($price_url);
		
		// Couldn't retrieve price
		if ($price == '["", "", ""]') {
			// Search without set
			$price_url = 'http://magictcgprices.appspot.com/api/tcgplayer/price.json?cardname='.rawurlencode($card['Card']['name_en']);
			// try & catch couldn't help it :(
			@$price = file_get_contents($price_url);
		}

		if ($price) {
			$price = json_decode($price);
			$avg_price = substr(str_replace(',', '', $price[0]), 1) + substr(str_replace(',', '', $price[1]), 1) + substr(str_replace(',', '', $price[2]), 1);
		} else {
			$avg_price = NULL;
		}
		$this->set('avg_price', $avg_price);
		#$this->set('avg_price', 1);
	}
	
	public function ajax() {
		$this->autoRender = false;

		if (isset($this->request->query['query'])) {
			$q = $this->request->query['query'];
			
			// Prepara a resposta ajax, devolvendo a consulta e as sugestões
			$suggestions = array_unique($this->Card->suggest($q));
			sort($suggestions);
			
			$out = array(
				'query' => $q,
				'suggestions' => $suggestions,
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
