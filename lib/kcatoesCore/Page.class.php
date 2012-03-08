<?php

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\Request;
use Goutte\Client;

/**
 * Wrapper de Goutte pour KCatoes
 *
 * @package Kcatoes
 * @author  Antoine Rolland <antoine.rolland@keyconsulting.fr>
 */
class Page extends Client
{
  private $content;
  private $logger;
  private $url;
  
  /**
   * Construit une page à partir d'une URL
   *
   * @param String   $_content Le contenu de la page
   * @param sfLogger $_logger  Le logger à utiliser (optionel)
   */
  public function __construct($_content, sfLogger $_logger = null, $_url=null)
  {
    $this->content = $_content;
    $this->logger  = $_logger;
    $this->url     = $_url;
    parent::__construct();
  }

  /**
   * Fonction d'accès aux paramètres de la classe
   *
   * @param  String $var Le nom de la variable à récupérer
   *
   * @return La valeur de la variable
   */
  public function __get($var)
  {
    return $this->$var;
  }

  /**
   * Génère le crawler de la page à partir de son contenu
   *
   * @date 25/02/2011
   */
  public function buildCrawler()
  {
    $this->addLogInfo('Génération du crawler');
    try
    {
      $this->crawler = new Crawler(null, '');
      $this->crawler->addHtmlContent($this->content);
    }
    catch (Exception $e)
    {
      $this->addLogErreur('Une erreur est survenue lors de la génération du crawler de la page');
      throw new KcatoesCrawlerException($e->getMessage());
    }
  }

  /**
   * Ajoute un message d'information au journal de log
   *
   * @param String $infoMessage Message à ajouter
   */
  private function addLogInfo($infoMessage)
  {
    if ($this->logger instanceof sfLogger)
    {
      $this->logger->info($infoMessage);
    }
  }

  /**
   * Ajoute un message d'erreur au journal de log
   *
   * @param String $errorMessage Message à ajouter
   */
  private function addLogErreur($errorMessage)
  {
    if ($this->logger instanceof sfLogger)
    {
      $this->logger->err($errorMessage);
    }
  }
}