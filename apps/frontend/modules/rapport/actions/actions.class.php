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
   * Rapport de tests d'une page
   * Dispatch simple/riche
   */
  public function executeRapportScenarioPage(sfWebRequest $request)
  {
    $mode = $request->getParameter('mode', 'simple');
    
    switch ($mode)
    {
      case 'riche':
        $this->forward('404');    
        break;
        
      case 'simple':
      default:
        $this->forward('rapport', 'rapportScenarioPageSimple');    
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
    $this->scenario   = $this->getRoute()->getObject();

    // Récupère les extractions sélectionnées
    $this->extractIds = $this->getUser()->getFlash('extractIds', array());
    // Re-set la variable flash pour éviter de la perdre (en cas re rechargement par exemple)
    $this->getUser()->setFlash('extractIds', $this->extractIds);
    
    $this->scenarioPages = $this->scenario->getScenarioPagesForExtractsWithGlobalResult($this->extractIds);

    $this->scenarioResult = $this->computeSimpleRapportResult($this->scenarioPages, $this->scenario->getNom());
  }
  
  public function executeRapportScenarioPageSimple(sfWebRequest $request)
  {
  	$this->scenario        = $this->getRoute()->getObject();
  	$this->extractIds      = explode('-',$request->getParameter('extractIds', array()));
  	$pageId                = $request->getParameter('idPage', '');
  	
  	$this->scenarioPage = $this->scenario->getScenarioPagesForExtractsWithGlobalResult($this->extractIds);
  	
  	$this->scenarioPageResult = $this->computeSimpleRapportResult($this->scenarioPage, $this->scenario->getNom());
  	$this->scenarioPage = $this->scenarioPage[0]; 
  }
  
  /**
   * Rapport de tests d'un scénario
   */
  public function executeRapportScenarioRiche(sfWebRequest $request)
  {    
    $this->initRapportScenario();
    
  }
  
  private function computeSimpleRapportResult($pages, $title)
  {
    TestsHelper::getRequired();
    
    // initialisation des tableaux de resultat
    $resultSynthese = array(
      Resultat::ECHEC     => 0
      ,Resultat::ERREUR   => 0
      ,Resultat::MANUEL   => 0
      ,Resultat::NA       => 0
      ,Resultat::NON_EXEC => 0
      ,Resultat::REUSSITE => 0
      ,'NB_APPLICABLE'    => 0
      ,'NB_COUVERT'       => 0
      ,'NB_TOTAL'         => 0
    );
    $resultNiveauSynthese = array(
      'A'         => $resultSynthese
      ,'AA'       => $resultSynthese
      ,'AAA'      => $resultSynthese
      ,'NB_TEST'  => 0
    );
    
    $reportSynthese = array(
      'GLOBAL' => $resultNiveauSynthese
      ,'THEMATIQUE' => array()
    );

    $allThematiques = TestsHelper::getAllThematiques();
    foreach ($allThematiques as $t)
    {
      $reportSynthese['THEMATIQUE'][$t] = $resultNiveauSynthese;
    }
    
    // Tableau de donnée finale à remplir
    $resultData = $reportSynthese;
    
    $resultData['TITLE'] = $title;
    
    // Parcours des resultats
    foreach($pages as $scenarioPage)
    {
      $webPageExtracts = $scenarioPage->getWebPage()->getCollectionExtracts();
      foreach($webPageExtracts as $webPageExtract)
      {
        
        $webPageExtractTests = $webPageExtract->getCollectionResults();
        foreach($webPageExtractTests as $test)
        {
          // propriétés du test
          $classTest = $test->getTest();
          $thematique = $classTest::getGroup('thematique');
          $niveau = $classTest::getGroup('niveau');
          $result = $test->getResult();
          
          // resultat GLOBAUX
          $resultData['GLOBAL'][$niveau][$result]++;
          
                // nombre de test
                switch ($result)
                {
                  case Resultat::ECHEC:
                  case Resultat::REUSSITE:
                    $resultData['GLOBAL'][$niveau]['NB_APPLICABLE']++;
                    break;
                }
                switch ($result)
                {
                  case Resultat::ECHEC:
                  case Resultat::REUSSITE:
                  case Resultat::NA:
                    $resultData['GLOBAL'][$niveau]['NB_COUVERT']++;
                    break;
                }
                switch ($result)
                {
                  case Resultat::ECHEC:
                  case Resultat::REUSSITE:
                  case Resultat::NA:
                  case Resultat::MANUEL:
                    $resultData['GLOBAL'][$niveau]['NB_TOTAL']++;
                    $resultData['GLOBAL']['NB_TEST']++;
                    break;
                }
          
                    
          // resultat par thematique
          $resultData['THEMATIQUE'][$thematique][$niveau][$result]++;


                  // nombre de test
                  switch ($result)
                  {
                    case Resultat::ECHEC:
                    case Resultat::REUSSITE:
                      $resultData['THEMATIQUE'][$thematique][$niveau]['NB_APPLICABLE']++;
                      break;
                  }
                  switch ($result)
                  {
                    case Resultat::ECHEC:
                    case Resultat::REUSSITE:
                    case Resultat::NA:
                      $resultData['THEMATIQUE'][$thematique][$niveau]['NB_COUVERT']++;
                      break;
                  }
                  switch ($result)
                  {
                    case Resultat::ECHEC:
                    case Resultat::REUSSITE:
                    case Resultat::NA:
                    case Resultat::MANUEL:
                      $resultData['THEMATIQUE'][$thematique][$niveau]['NB_TOTAL']++;
                      $resultData['THEMATIQUE'][$thematique]['NB_TEST']++;
                      break;
                  }
          

        }
      }
    }
    return $resultData;
  }
  
}
