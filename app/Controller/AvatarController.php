<?php

App::uses('AppController', 'Controller');
CakePlugin::load('ImageCropResize');

class AvatarController extends AppController {
	
	public $components = array('ImageCropResize.Image');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
	public function index() {
		$this->autoRender = false;
		
		// Autenticado? Mandou foto? Erro no arquivo?
		if (!$this->Auth->user('id') || !isset($this->request->data['avatar']) || $this->request->data['avatar']['error']) {
			$this->Session->setFlash('Problema no envio da imagem. Por favor, tente novamente.', 'default', array(), 'error');
			$this->redirect('/profile');
		}
		
		$user_id = $this->Auth->user('id');
		
		$img_tmp = $this->request->data['avatar']['tmp_name'];
		
		// Pega as dimensões da imagem
		try {
			$img_size = getimagesize($img_tmp);
		} catch (Exception $e) {
			$img_size = false;
		}
		
		// Verifica se a imagem é válida (!= false e não jpg nem png)
		if (!$img_size || ($img_size[2] != 2 && $img_size[2] != 3)) {
			$this->Session->setFlash('Sua imagem é inválida. Por favor, tente novamente.', 'default', array(), 'error');
			$this->redirect('/profile');
		}
				
		// Verifica se a imagem é grande demais e depois salva uma cópia para recorte
		/* //Rotina antiga
		if ($img_size[0] > 800 || $img_size[1] > 800) {
			$options = array(
				'width' => 800,
				'height' => 800,
				'detectPath' => false,
			);
		*/
		
		$out = $this->Image->resize($img_tmp, array(
			'width' => 250,
			'height' => 250,
			'crop' => true,
			'autocrop' => true,
			'detectPath' => false,
		));
		
		if (!$out) {
			$this->Session->setFlash('Sua imagem é inválida. Por favor, tente novamente.', 'default', array(), 'error');
			$this->redirect('/profile');
		}

		// Grava a imagem para ser recortada
		$img_crop = "./img/avatar/avatar_{$user_id}.jpg";
		if (file_exists($img_crop))
			unlink($img_crop);
		
		
		if (!rename('.'.$out, $img_crop)) {
			$this->Session->setFlash('Sua imagem é inválida. Por favor, tente novamente.', 'default', array(), 'error');
			$this->redirect('/profile');
		} else {
			$this->User->setAvatar($user_id, basename($img_crop));
			$this->Session->setFlash('Sua foto foi atualizada com sucesso! <strong>Pode demorar alguns minutos até que a alteração tenha afeito.</strong>', 'default', array(), 'success');
			$this->redirect('/profile');
		}

		
	}
	
}