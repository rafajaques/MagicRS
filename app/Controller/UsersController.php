<?php
// app/Controller/UsersController.php
class UsersController extends AppController {
	var $uses = array('User', 'City');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
		$this->set('title_for_layout', __('Usuários'));
    }
	
    public function index() {
        /*$this->User->recursive = 0;
        $this->set('users', $this->paginate());*/
		if ($this->Auth->user('role') != 'admin')
			$this->redirect('/');
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

	/**
	 * Gravar os dados do usuário no banco
	 */
    public function add() {
		$this->set('section_for_layout', __('Cadastro'));
		// Caso exista envio de formulário
        if ($this->request->is('post')) {
            $this->User->create();
			
			// Adiciona valores padrão ao usuário
			$this->request->data['User']['role'] = 'user';
			$this->request->data['User']['active'] = '1';
			
			// Salva os dados
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Cadastro realizado com sucesso.', 'default', array(), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Não foi possível realizar o cadastro. Por favor, tente novamente.', 'default', array(), 'error');
            }
        }
		
		$this->set('cidades', $this->City->find('list', array(
														'fields' => array('id', 'name'),
														'order' => array('name' => 'asc'),
														)));
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Dados salvos.'), 'default', array(), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possível salvar. Por favor, tente novamente.'), 'default', array(), 'error');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash('Usuário removido', 'default', array(), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Usuário não removido', 'default', array(), 'error');
        $this->redirect(array('action' => 'index'));
    }

	public function login() {
		$this->set('section_for_layout', __('Identifique-se'));
		
	    if ($this->Auth->login()) {
			$this->Session->write('username', $this->Auth->user('username'));
	        $this->redirect($this->Auth->redirect());
	    }
	}

	public function logout() {
	    $this->redirect($this->Auth->logout());
	}
}