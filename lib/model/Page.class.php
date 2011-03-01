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
	private $logger;

	public function __construct($_url, $_logger = null)
	{
		$this->url = $_url;
		$this->logger = $_logger;
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
	 * Vérifie la validité de l'url de la page puis génère son crawler
	 *
	 * @date 25/02/2011
	 */
	public function buildCrawler()
	{
		try
		{
			UrlValidation::isValide($this->url);
		}
		catch(KcatoesUrlException $e)
		{
			$errorMessage = $e->getMessage();
      $this->addLogErreur($errorMessage);
			throw new KcatoesCrawlerException($errorMessage);
		}
		$this->request('GET', $this->url);
	}

  /**
   * Ajoute un message d'erreur au journal de log
   *
   * @param String $errorMessage Message à ajouter
   */
	private function addLogErreur($errorMessage)
	{
		if($this->logger instanceof sfLogger)
		{
			$this->logger->err($errorMessage);
		}
	}
}