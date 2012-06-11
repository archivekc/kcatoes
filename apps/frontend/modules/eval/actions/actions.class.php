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
    
    $userTest = $this->getUser()->getGuardUser()->getProfilAndUserTest();
    
    $subResult = array();
    
    foreach($this->results as $result)
    {
    	if (in_array($result->getClass(), $userTest))
    	{
	      $cptLine++;
	      $test = $result->getClass();
	      $fields['select'][]   = Tester::computeIdForTest('mainResult_'.$test::testId);
	      $fields['select'][]   = Tester::computeIdForTest('subResult'.$cptLine.'_'.$test::testId);
	      $fields['textarea'][] = Tester::computeIdForTest('annot'.$cptLine.'_'.$test::testId);
	      $subResult[$test::testId] = $result; 
    	}
    }
    /*
    $subResult = array_flip($subResult);
    natcasesort($subResult);
    $subResult = array_flip($subResult);*/

    $subSubResult = array();
    $keys = array_keys($subResult);
    natsort($keys);
    foreach($keys as $key)
    {
      array_push($subSubResult, $subResult[$key]);    	
    }
    
//    ksort($subResult);
//    $subResult = array_values($subResult);
//    
    
    
    $this->results = $subSubResult;
  }
  
  /**
   * Passage des tests sur une page 
   * FIXME : obsolète ?
   * 
   * @param sfWebRequest $request
   */
  public function executeExecuteTests(sfWebRequest $request)
  {
  	set_time_limit(0);
  	
  	// FIXME : à priori, ils sont déjà en paramètres de la requête
  	// donc pas besoin de passer par variable flash (peut-être pas dans tous les cas ?)
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
        // TODO : historisation
        $resPrec = $extract->getCollectionResults();
        $resPrec->delete();
	      
        // Nouvel enregistrement pour le résultat global
        $result = new TestResult();
        $result->saveResult($extract, $resTest);
	    }
    }
  	
    $this->getUser()->setFlash('testsMsg', 'Tests exécutés');
    
  }

  /**
   * Exécution d'un tir de tests sur un scénario
   * @param sfWebRequest $request
   * @return unknown_type
   */
  public function executeExecutionTests(sfWebRequest $request)
  {
    // Temps maximal d'exécution de l'action (en µs)
    // TODO : paramétrable en conf
    $TIME_MAX   = 2 * 1000000; 
    
    // Temps total d'exécution de l'action (en µs)
    $timeTotal = 0;
    
    // Inclusion des classes de test
    TestsHelper::getRequired();
    
    // Extractions à prendre en compte
    $extractIds = $request->getParameterHolder()->get('extracts');
    
    $extracts = Doctrine::getTable('WebPageExtract')->findByDql('id in ?', array($extractIds));
    
    $extractionsTotal = count($extractIds); 

    // Récupération de tous les tests
    $allTests = TestsHelper::getAllTestsFromDir();
    $testsTotal = count($allTests);
    
    $total = $testsTotal * $extractionsTotal;
    
    // Index courant
    $currentIndex    = $request->getParameterHolder()->get('index');    

        
    // Exécution des tests, tant qu'il en reste et qu'on n'a pas dépassé le temps imparti
    while ($timeTotal < $TIME_MAX && $currentIndex < $total)
    {
      $timeStart = microtime(true);
      
      // Mise à jour des index
      $extractionIndex = floor($currentIndex / $testsTotal);
      $testsIndex      = $currentIndex % $testsTotal;
      
      // TODO : à faire dans un try{} (il faut impérativement capturer toutes les erreurs pour retourner toujours la sortie en JSON)
      
      // Instanciation du wrapper
      $extract = $extracts[$extractionIndex];
      $test = $allTests[$testsIndex];
      $kcatoes = new KcatoesWrapper(array($test), $extract->getSrc());

      // Suppression des résultats précédents
      // TODO : historisation
      if ($testsIndex == 0)
      {
        $resPrec = $extract->getCollectionResults();
        $resPrec->delete();
      }
      
      // Lancement du prochain test
      // TODO : à faire dans un try{} (il faut impérativement capturer toutes les erreurs pour retourner toujours la sortie en JSON)
      // TODO : factoriser (intégrer à quelque chose dans /lib/, KCatoesWrapper ou autre)
      $results  = $kcatoes->run();
      $this->resTests = $kcatoes->getResTests();

      // Sauvegarde en base
      foreach($this->resTests as $resTest)
      {
        // Nouvel enregistrement pour le résultat global
        $result = new TestResult();
        $result->saveResult($extract, $resTest);
      }
      
      // Calcul du temps d'exécution
      $timeEnd = microtime(true);
      $timeTotal += ($timeEnd - $timeStart) * 1000000;
      
      // Mise à jour du compteur
      $currentIndex++;
      
      unset($kcatoes);
    }
    
    // Retour du résultats
    echo json_encode(array('executes'=>$currentIndex, 'total'=>$total));
    
    return sfView::NONE;
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
