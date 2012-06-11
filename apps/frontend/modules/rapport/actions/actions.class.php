<?php

/**
 * rapport actions.
 *
 * @package    kcatoes
 * @subpackage rapport
 * @author     Key Consulting
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
use MyApp\TestHelper;
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
    
    $this->webpages = $this->scenario->getScenarioPagesForExtracts($this->extractIds);
    
    
    
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

    TestsHelper::getRequired();
    
    // initialisation des tableaux de resultat
    $resultSynthese = array(
      Resultat::ECHEC     => 0
      ,Resultat::ERREUR   => 0
      ,Resultat::MANUEL   => 0
      ,Resultat::NA       => 0
      ,Resultat::NON_EXEC => 0
      ,Resultat::REUSSITE => 0
    );
    $resultNiveauSynthese = array(
      'A'     => $resultSynthese
      ,'AA'   => $resultSynthese
      ,'AAA'  => $resultSynthese
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
    
    // rapports au niveau Scenario / Page / Extraction
    $this->scenarioResult = $reportSynthese;
    $this->scenarioPagesResult = array();
    $this->scenarioPagesExtractResult = array();
    
    $this->scenarioResult['TITLE'] = $this->scenario->getNom();
    
    // Parcours des resultats
    foreach($this->scenarioPages as $scenarioPage)
    {
    	// resultat niveau page
    	$pageResult = $reportSynthese;
    	$pageResult['TITLE'] = $scenarioPage->getNom().' - '. $scenarioPage->getWebPage()->getUrl();
    	
    	$webPageExtracts = $scenarioPage->getWebPage()->getCollectionExtracts();
    	foreach($webPageExtracts as $webPageExtract)
    	{
    		
    		// resultat niveau extraction
    		$extractResult = $reportSynthese;
    		$extractResult['TITLE'] = $webPageExtract->getType();
    		
    		$webPageExtractTests = $webPageExtract->getCollectionResults();
    		foreach($webPageExtractTests as $test)
    		{
    			// propriétés du test
    			$classTest = $test->getTest();
    			$thematique = $classTest::getGroup('thematique');
    			$niveau = $classTest::getGroup('niveau');
    			$result = $test->getResult();
    			
    			// resultat GLOBAUX
    			$this->scenarioResult['GLOBAL'][$niveau][$result]++;
    			$pageResult['GLOBAL'][$niveau][$result]++;
    			$extractResult['GLOBAL'][$niveau][$result]++;
    			
    			// resultat par thematique
    			$this->scenarioResult['THEMATIQUE'][$thematique][$niveau][$result]++;
    			$pageResult['THEMATIQUE'][$thematique][$niveau][$result]++;
    			$extractResult['THEMATIQUE'][$thematique][$niveau][$result]++;
    			
    			/*
    			echo $scenarioPage->getNom();
    			echo ' - ';
    			echo $scenarioPage->getWebPage()->getUrl();
    			echo ' - ';
    			echo $webPageExtract->getType();
    			echo ' - ';
    			echo $test->getTest();
    			echo ' - ';
    			echo $thematique;
    			echo ' - ';
    			echo $niveau;
    			echo "<br/>\n";*/
    		}
    		array_push($this->scenarioPagesExtractResult, $extractResult);
    	}
    	array_push($this->scenarioPagesResult, $pageResult);
    }
  }
  
  /**
   * Rapport de tests d'un scénario
   */
  public function executeRapportScenarioRiche(sfWebRequest $request)
  {    
    $this->initRapportScenario();
    
  }
  

  
}
