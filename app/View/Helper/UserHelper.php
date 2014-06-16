<?php

App::uses('AppHelper', 'View/Helper');
App::import("Model", "User");  

class UserHelper extends AppHelper {

	public function getAvatar($id_user) {
		$u = new User();
		$avatar = $u->getAvatar($id_user);
		
		if ($avatar)
			return $avatar;
		else
			return '/img/no-avatar.jpg';
	}

}