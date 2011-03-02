<?php

/**
 * test actions.
 *
 * @package    kcatoes
 * @subpackage test
 * @author     Adrien Couet
 */
class testActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
//    $test = new Test();
//    $test->setNom("\t toto \n");
//    $this->nom = $test->getNom();
//    $this->nomCourt = $test->getNomCourt();
//    $this->urlDeTest = 'http://www.keyconsulting.fr/'; //Valide
//    $this->urlDeTest = 'www.jesuisdeconnecte.fr';      //404
    $this->urlDeTest = 'http://abonnes.lemonde.fr/';   //302
//    $this->urlDeTest = 'toto';                         //Syntaxe invalide
//    $this->urlDeTest = 'http://www.keyconsulting.fr/images/KeyConsulting.jpg'; //Format invalide

    $page = new page($this->urlDeTest, sfContext::getInstance()->getLogger());

    try
    {
    	$page->buildCrawler();
    } catch (KcatoesCrawlerException $e)
    {
    	$this->getRequest()->setParameter('errorMessage', $e->getMessage());
    	$this->forward('Test', 'Erreur');
    }
    $crawler = $page->crawler;
    $nodes = $crawler->filter('div');
    $this->nbDiv = $nodes->count();

    //A terme, initialisé par la configuration des tests
    $listeIds = array();

    $tester = new Tester($page, Doctrine::getTable('Test')->getCollectionFromIds($listeIds));
  }

  public function executeErreur(sfWebRequest $request)
  {
  	$this->errorMessage = $this->getRequest()->getParameter('errorMessage');
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeGoutte(sfWebRequest $request)
  {
    $this->urlDeTest = 'http://www.keyconsulting.fr/';

    $page = new Page();
    $crawler = $page->request('GET', $this->urlDeTest);
    $nodes = $crawler->filter('div');
    $this->nbDiv = $nodes->count();
  }
}
