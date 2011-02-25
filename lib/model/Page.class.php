<?php

use Symfony\Component\BrowserKit\Request;
use Goutte\Client;

/**
 * Wrapper de Goutte pour KCatoes
 *
 * @author Antoine Rolland
 *
 */
class Page extends Client
{
  private $url;

  public function __construct($_url)
  {
  	$this->url = $_url;
  	parent::__construct();
  }

  public function __get($var)
  {
  	return $this->$var;
  }

  /**
   * Gère les get et les set pour les attributs de la classe
   *
   * @throws Exception
   */
//  public function __call($method, $arguments)
//  {
//  	if (in_array($verb = substr($method, 0, 3), array('set', 'get')))
//  	{
//  		$name = strtolower(substr($method, 3));
//
//  		if (in_array($name, get_class_vars(get_class($this))))
//  		{
//  			if ($verb == 'get')
//  			{
//  				return $this->$name;
//  			}
//  			else
//  			{
//  				$this->$name = $arguments[0];
//  			}
//  		}
//  		else
//  		{
//  			throw new Exception('Variable '.$name.' introuvable');
//  		}
//  	}
//  }

  /**
   * Vérifie la validité de l'url de la page puis génère son DOM
   *
   * @date 25/02/2011
   */
  public function buildCrawler()
  {
  	if(UrlValidation::isValide($this->url))
  	{
  		$this->request('GET', $this->url);
  	}
  	else
  	{
  		die();
  	}
  }
}