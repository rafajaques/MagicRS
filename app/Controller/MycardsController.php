<?php

App::uses('AppController', 'Controller');

class MycardsController extends AppController {
	public $uses = array('UserCard', 'Card', 'WantList');
	public $helpers = array('Mtg');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('title_for_layout', 'Minhas Cartas');
	}

	public function index() {
		// Envia o nome da seção atual
		$this->set('section_for_layout', __('Principal'));

		// Buscar todas as cartas da coleção pessoal
		$collec = $this->UserCard->find('all', array(
			'joins' => array(
				array(
					'table' => 'cards',
					'alias' => 'Card',
					'type' => 'LEFT',
					'conditions' => array('UserCard.id_card = Card.id'),
				),
				array(
					'table' => 'sets',
					'alias' => 'Set',
					'type' => 'LEFT',
					'conditions' => array('Card.id_set = Set.id'),
				),
			),
			'conditions' => array(
				'UserCard.id_user' => $this->Auth->user('id'),
		    ),
			'fields' => array(
				'Card.*',
				'UserCard.quantity',
				'UserCard.note',
				'UserCard.have_list',
				'Set.name as set_name',
				'Set.code as code',
				'Set.release'
			),
			'order' => 'Card.name ASC, Set.release DESC',
		));
		
		$this->set('collec', $collec);
		$this->set('have_list_count', $this->UserCard->haveListCount($this->Auth->user('id')));
		$this->set('want_list_count', $this->WantList->wantListCount($this->Auth->user('id')));
	}
	
	public function add() {
		// Desativa a view
		$this->autoRender = false;
		
		// Adiciona valores padrão ao usuário
		$this->request->data['id_user'] = $this->Auth->user('id');
		$this->request->data['added'] = date('Y-m-d H:i:s');
        
		if ($this->request->is('post')) {
            $this->UserCard->create();
			
			// Salva os dados
            if (!$this->UserCard->save($this->request->data)) {
                $this->Session->setFlash('Não foi possível registrar sua carta. Por favor, tente novamente.', 'default', array(), 'error');
            }
			
			$this->Session->setFlash('Carta adicionada com sucesso.', 'default', array(), 'success');
			
			$this->redirect($this->referer());
        } else {
			$this->redirect(array('action' => 'index'));
        }
	}
	
	public function addwant() {
		// Desativa a view
		$this->autoRender = false;
		
		// Adiciona valores padrão ao usuário
		$this->request->data['id_user'] = $this->Auth->user('id');
		$this->request->data['added'] = date('Y-m-d H:i:s');
		
		#debug($this->request->data);die;
        
		if ($this->request->is('post')) {
            $this->WantList->create();
			
			// Salva os dados
            if (!$this->WantList->save($this->request->data)) {
                $this->Session->setFlash('Não foi possível registrar sua carta. Por favor, tente novamente.', 'default', array(), 'error');
            }
			
			$this->Session->setFlash('Carta adicionada com sucesso.', 'default', array(), 'success');
			
			$this->redirect($this->referer());
        } else {
			$this->redirect(array('action' => 'index'));
        }
	}
	
	public function bulk() {
		$this->set('section_for_layout', 'Adição em massa');
		
		if ($this->request->is('post') && !empty($this->request->data['cards'])) {
			// Lista as cartas encontradas e não encontradas no $out
			$out = array('cards' => array(), 'errors' => 0);
			
			$cards = explode("\n", $this->request->data['cards']);
			foreach ($cards as $c) {
				$c = trim($c);
				if (!empty($c)) {
					// $extract[1] == quantidade; $extract[2] == carta
					preg_match('/(\d?)(.+)/', $c, $extract);

					if (!empty($extract[2]) && $card = $this->Card->getCardByName($extract[2])) {
						// Se não existe quantidade, ela é 1
						$card['Card']['quantity'] = $extract[1] ? $extract[1] : 1;
						$out['cards'][] = $card;
					} else {
						$out['cards'][] = array(
							'error' => 1,
							'text' => $c,
						);
						$out['errors']++;
					}
				}
			}

			$this->set('bulk', $out);
		}
	}

	public function bulkadd() {
		$this->autoRender = false;
		if (!$this->request->is('post'))
			$this->redirect('/mycards');
		
		$id_cards = $this->request->data('id_card');

		// Caso não haja IDs, cria um array vazio
		if (!is_array($id_cards))
			$id_cards = array();
		
		$quantities = $this->request->data('quantity');
		$have = $this->request->data('have');
		
		$id_user = $this->Auth->user('id');
		
		$saved = $ignored = 0;
		
		foreach ($id_cards as $k => $id) {
			if (!$this->UserCard->hasCard($id_user, $id)) {
				$uc = $this->UserCard->create();
				$data = array('UserCard' => array(
					'id_user' => $id_user,
					'id_card' => $id,
					'quantity' => $quantities[$k],
					'have_list' => $have,
				));
			
				$this->UserCard->save($data);
				$saved++;
			} else {
				$ignored++;
			}
		}

		$this->Session->setFlash("Cartas inseridas com sucesso. <small>(Salvas: {$saved} - Ignoradas: {$ignored})</small>", 'default', array(), 'success');
		$this->redirect('/mycards');
	}
	
	public function want() {
		?>
		<h2>N&atilde;o implementado :(</h2>
		<a href="#" onclick="window.history.back();return false;">Voltar</a>
		<?php
		die;
	}
	
	// Ajax
	public function update() {
		$this->autoRender = false;
		
		if (empty($this->request->data) || !$id = $this->Auth->user('id')) {
			echo 'NULL';
			die;
		}
		
		$data = $this->request->data;
		
		$save = array(
			'UserCard.quantity' => intval($data['quantity']),
			'UserCard.note' => strlen($data['note']) ? '"'.addslashes($data['note']).'"' : NULL,
			'UserCard.have_list' => (bool) $data['have_list'],
		);

		$id_card = intval($data['id_card']);
		$conditions = array('UserCard.id_card' => $id_card, 'UserCard.id_user' => $id);
		
		$saved = $this->UserCard->updateAll($save, $conditions);
		
		echo $saved;
	}
}
