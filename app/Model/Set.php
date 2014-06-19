<?php

App::uses('AuthComponent', 'Controller/Component');

class Set extends AppModel {
    public $name = 'sets';
	
	public function getAll() {
		$rs = $this->find('all', array('order' => 'release DESC'));
		
		$out = array();
		
		foreach ($rs as $r) {
			$r = $r['Set'];

			$save = ($r['name'] == $r['name_en']) ? $r['name'] : "{$r['name']} ({$r['name_en']})";
			
			if ($r['block'])
				$out[$r['block']][$r['id']] = $save;
			else
				$out[$r['id']] = $save;
		}

		return $out;
	}
}