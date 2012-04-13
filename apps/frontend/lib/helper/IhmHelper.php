<?php
/**
 * Affiche un message utilisateur
 * @param String $msg: le message à afficher
 * @param String $type: le type du message (info, warning, success ou error)
 * @param String $balise: la balise utilisée pour afficher le message (div par défaut)
 * @param Array $attributes: attributs supplémentaires à ajouter à la balise
 */
function userMsg($msg, $type, $balise = 'div', $attributes = array())
{
	if (!isset($attributes['class'])){
		$attributes['class'] = '';
	}
	$attributes['class'] .= ' msg '.$type;
	$str = '<'.$balise;
	foreach ($attributes as $attribute => $value)
	{
		$str .= ' '.$attribute.'="'.$value.'"';
	}
	
	$str .= '>';
	switch($type){
		case 'info':
			$str .= image_tag(url_for('/', true).'img/ico/information.png', array('alt'=>'Information :'));
			break;
		case 'warning':
			$str .= image_tag(url_for('/', true).'img/ico/warning.png', array('alt'=>'Avertissement :'));
			break;
		case 'error':
			$str .= image_tag(url_for('/', true).'img/ico/error.png', array('alt'=>'Erreur :'));
			break;
		case 'success':
			$str .= image_tag(url_for('/', true).'img/ico/success.png', array('alt'=>'Confirmation :'));
			break;
	}
  
	$str .= "\n".$msg.'</'.$balise.'>'."\n";
	
	return $str; 
}