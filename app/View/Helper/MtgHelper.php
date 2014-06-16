<?php

App::uses('AppHelper', 'View/Helper');

class MtgHelper extends AppHelper {
    
	/**
	 * Retorna a raridade em formato badge
	 */
	public function rarity($string) {
		switch ($string) {
			case 'mythic':
				$out = '<span class="hide">1</span><small class="badge bg-red">Mítica</small>';
				break;
			case 'rare':
				$out = '<span class="hide">2</span><small class="badge bg-yellow">Rara</small>';
				break;
			case 'uncommon':
				$out = '<span class="hide">3</span><small class="badge bg-silver">Incomum</small>';
				break;
			case 'common':
				$out = '<span class="hide">4</span><small class="badge bg-black">Comum</small>';
				break;
		}
		
		return $out;
    }
	
	/**
	 * Retorna um custo de mana em imagens
	 */
	public function manaCost($string, $size = 16) {
		// Montagem do custo de mana
		if (is_array($string)) {
			$string = $string[0];
		}
		$cost = preg_match_all('/\{(\w+\/?\w?)\}/i', $string, $saida);
		$out = '';

		foreach($saida[1] as $val) {
			$val = str_replace('/', '', $val);
			
			if ($val == 'T' || $val == 'Q')
				$out .= "<img src=\"http://mtgimage.com/symbol/other/{$val}/{$size}.png\">";
			else
				$out .= "<img src=\"http://mtgimage.com/symbol/mana/{$val}/{$size}.png\">";
		}

		return $out;
	}
	
	/**
	 * Retorna um custo de mana em imagens
	 */
	public function manaCostInText($string, $size = 16) {
		// Montagem do custo de mana		
		$out = preg_replace_callback('/(\{\w+\/?\w?\})/i', array($this, 'manaCost'), $string);

		return $out;
	}
	
	/**
	 * Retorna os símbolos de mana em imagem de acordo com cores por extenso em inglês
	 */
	public function manaImagesByColors($string, $size = 16) {
		$colors = explode(',', $string);

		$out = '';
		
		foreach ($colors as $c) {
			$out .= "<img src=\"http://mtgimage.com/symbol/mana/{$c}/{$size}.png\">";
		}

		return $out;
	}
	
	/**
	 * Pega a imagem da carta pelo multiverseid
	 */
	public function imageByMultiverseId($id) {
		return "http://mtgimage.com/multiverseid/{$id}.jpg";
	}
	
}