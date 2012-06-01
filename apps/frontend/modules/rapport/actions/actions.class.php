<?php

/**
 * rapport actions.
 *
 * @package    kcatoes
 * @subpackage rapport
 * @author     Key Consulting
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rapportActions extends sfActions
{ 

  /**
   * Rapport de tests d'un scénario
   * Dispatch simple/riche
   */
  public function executeRapportScenario(sfWebRequest $request)
  {
    $mode = $request->getParameter('mode', 'simple');
    
    switch ($mode)
    {
      case 'riche':
        $this->forward('rapport', 'rapportScenarioRiche');    
        break;
        
      case 'simple':
      default:
        $this->forward('rapport', 'rapportScenarioSimple');    
    }
  }
  
  /**
   * Initialise les éléments communs utiles pour les rapports simple et riche
   * @return unknown_type
   */
  public function initRapportScenario()
  {
    $this->scenario   = $this->getRoute()->getObject();    
    
    // Récupère les extractions sélectionnées
    $this->extractIds = $this->getUser()->getFlash('extractIds', array());
    
    // Re-set la variable flash pour éviter de la perdre (en cas re rechargement par exemple)
    $this->getUser()->setFlash('extractIds', $this->extractIds);
    
    // Récupère les tests associés à l'utilisateur
    // TODO
                        
    // Récupération des classes de tests associées au(x) profil(s) de l'utilisateur
    $tests = array();
    foreach($this->getUser()->getGroups() as $group)
    {
      $g_tests = $group->getCollectionTests();
      foreach($g_tests as $test)
      {
        $class = $test->getClass();
        $tests[$class] = $class;
      }
    }
    
    // Chargement des classes de test
    TestsHelper::getRequired();
    
    $this->tests = array_values($tests);
  }
  
  
  /**
   * Rapport de tests d'un scénario
   */
  public function executeRapportScenarioSimple(sfWebRequest $request)
  {
    $this->initRapportScenario();
    
  }
  
  /**
   * Rapport de tests d'un scénario
   */
  public function executeRapportScenarioRiche(sfWebRequest $request)
  {    
    $this->initRapportScenario();
    
  }
  

  
}
