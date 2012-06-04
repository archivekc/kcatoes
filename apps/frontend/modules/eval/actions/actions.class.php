<?php
/**
 * eval actions.
 *
 * @package    kcatoes
 * @subpackage eval
 * @author     cfabby
 */
class evalActions extends kcatoesActions
{
  public function preExecute()
  {
  }
 /**
   * Affichage des résultats d'un test
   * @param sfWebRequest $request
   */
  public function executeResultatTests(sfWebRequest $request)
  {
    $this->extraction = $this->getRoute()->getObject();
    $this->page       = $this->extraction->getWebPage();
    
    // Inclusion des classes de test
    TestsHelper::getRequired();
  }
  

  /**
   * Affichage des résultats d'un test
   * Interface riche
   * @param sfWebRequest $request
   */
  public function executeResultatTestsRiche(sfWebRequest $request)
  {
    $this->extraction = $this->getRoute()->getObject();
    $this->page       = $this->extraction->getWebPage();
    
    // Inclusion des classes de test
    TestsHelper::getRequired();

    $this->title    = 'KCatoès - Rapport de test';
    $this->subtitle = $this->page->getUrl(); // TODO : date du test
    
    $this->output = '';
    
    $this->score = ''; // TODO { was: $kcatoes->getScore()*100;) }
    
    $fields = array();

    $output = '';
    $fields['select'] = array();
    $fields['textarea'] = array();

    $this->results = $this->extraction->getCollectionResults();

    // 
    $this->history = true;
    
    // Champs pour formulaire d'historisation
    $cptLine = -1;
    foreach($this->results as $result)
    {
      $cptLine++;
      $test = $result->getClass();
      $fields['select'][]   = Tester::computeIdForTest('mainResult_'.$test::testId);
      $fields['select'][]   = Tester::computeIdForTest('subResult'.$cptLine.'_'.$test::testId);
      $fields['textarea'][] = Tester::computeIdForTest('annot'.$cptLine.'_'.$test::testId);
    }
  }
  
  /**
   * Passage des tests
   * 
   * @param sfWebRequest $request
   */
  public function executeExecuteTests(sfWebRequest $request)
  {
  	set_time_limit(0);
  	
	set_time_limit(0);
  	$extractIds = $this->getUser()->getFlash('extractIds', null);
    if (!is_array($extractIds))
    {
    	throw new KcatoesTesterException();
    }
    $extracts = Doctrine::getTable('WebPageExtract')->findByDql('id in ?',array($extractIds));
    // Inclusion des classes de test
    TestsHelper::getRequired();
    $allTests = TestsHelper::getAllTestsFromDir();
    
    foreach($extracts as $extract)
    {
    	// Instanciation du wrapper
      $kcatoes = new KcatoesWrapper($allTests, $extract->getSrc());
      
      // Lance les tests
	    $results  = $kcatoes->run();
	    $this->resTests = $kcatoes->getResTests();
	    
	    // Sauvegarde en base
	    foreach($this->resTests as $resTest)
	    {      
	      // Suppression des résultats précédents
	      // TODO : optimisation
	      $resPrec = $extract->getCollectionResults();
	      foreach($resPrec as $r)
	      {
	        $r->delete();
	      }
	      
	      // Nouvel enregistrement pour le résultat global
	      $result = new TestResult();
	      $result->setWebPageExtractId($extract->getId());
	      $result->setClass(get_class($resTest));
	      $result->setNumCategorie($resTest::getNumeroCategorie());
	      $result->setNumTest($resTest::getNumeroTest());
	      $result->setResult($resTest->getMainResult());
	      $result->save();
	      
	      // Parcours du détail des résultats
	      foreach($resTest->getTestResults() as $res)
	      {
	        // Nouvelle ligne de résultat
	        $rLine = new TestResultLine();
	        
	        $rLine->setTestResult($result);
	        
	        $rLine->setResult($res['result']);
	        $rLine->setComment($res['comment']);
	        $rLine->setXpath($res['xpath']);
	        $rLine->setCssSelector($res['cssSelector']);
	        $rLine->setSource($res['source']);
	        $rLine->setPrettySource($res['prettySource']);
	        if (is_object($res['node'])) {
	          $rLine->setTextContent($res['node']->textContent);
	        }
	        $rLine->save();
	      }
	    }
    }
  	
    $this->getUser()->setFlash('testsMsg', 'Tests exécutés');
    
  }

  /**
   * Sauvegarde des résultats après édition manuelle
   * 
   * @param sfWebRequest $request
   */
  public function executeSauvegardeResultat(sfWebRequest $request)
  {
    $this->extraction = $this->getRoute()->getObject();
    
    // *** Récupération des résultats *actuels* associés à l'extraction
    $results = $this->extraction->getResultsForUpdate();
    
    // Parcours des résultats de test
    foreach($results as $result)
    {
      // Réupération du résultat envoyé
      $newTestResult = $request->getParameter('mainResult_'.$result->getId(), 'ERREUR');
      
      // Enregistrement
      $result->setResult(Resultat::getValue($newTestResult));
      
      // Parcours des lignes de résultats de test
      $collectionLines = $result->getCollectionLines(); 
      foreach ($collectionLines  as $resultLine)
      {
        // Réupération du sous-résultat envoyé
        $newTestSubResult = $request->getParameter('subResult_'.$resultLine->getId(), 'ERREUR');
        
        // Réupération de l'annotation envoyée
        $newTestAnnot = $request->getParameter('annot_'.$resultLine->getId(), '');
        
        // Enregistrement  
        $resultLine->setResult(Resultat::getValue($newTestSubResult));
        $resultLine->setAnnotation($newTestAnnot);
      } 
    }
    
    // Sauvegarde en base
    try
    {
      $results->save();
      $this->getUser()->setFlash('success', 'Résultats enregistrés');
    }
    catch(Exception $e) 
    {
      $this->getUser()->setFlash('error', 'Erreur lors de l\'enregistrement');      
    }
    
    $this->redirect('pageResultatTestsRiche', $this->extraction);
  }
}
