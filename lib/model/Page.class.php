<?php

use Symfony\Component\BrowserKit\Request;
use Goutte\Client;

/**
 * Wrapper de Goutte pour KCatoes
 *
 * @package Kcatoes
 * @author Antoine Rolland <antoine.rolland@keyconsulting.fr>
 */
class Page extends Client
{
  private $url;
  private $logger;

  /**
   * Construit une page à partir d'une URL
   *
   * @param String   $_url    L'URL de la page
   * @param sfLogger $_logger Le logger à utiliser (optionel)
   */
  public function __construct($_url, sfLogger $_logger = null)
  {
    $this->url = $_url;
    $this->logger = $_logger;
    parent::__construct();
  }

  /**
   * Fonction d'accès aux paramètres de la classe
   *
   * @param  String $var Le nom de la variable à récupérer
   * @return La valeur de la variable
   */
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
  //    if (in_array($verb = substr($method, 0, 3), array('set', 'get')))
  //    {
  //      $name = strtolower(substr($method, 3));
  //
  //      if (in_array($name, get_class_vars(get_class($this))))
  //      {
  //        if ($verb == 'get')
  //        {
  //          return $this->$name;
  //        }
  //        else
  //        {
  //          $this->$name = $arguments[0];
  //        }
  //      }
  //      else
  //      {
  //        throw new Exception('Variable '.$name.' introuvable');
  //      }
  //    }
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
      $errorMessage = 'L\'URL indiquée n\'est pas valide: '.$e->getMessage();
      $this->addLogErreur($errorMessage);
      throw new KcatoesCrawlerException($errorMessage);
    }
    $this->request('GET', $this->url);
    $this->addLogInfo('Génération du crawler - Ok');
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

  /**
   * Ajoute un message d'information au journal de log
   *
   * @param String $infoMessage Message à ajouter
   */
  private function addLogInfo($infoMessage)
  {
    if($this->logger instanceof sfLogger)
    {
      $this->logger->info($infoMessage);
    }
  }
}