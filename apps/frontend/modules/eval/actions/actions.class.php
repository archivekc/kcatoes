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
  public function executeEvaluationSimple(sfWebRequest $request)
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
  public function executeEvaluation(sfWebRequest $request)
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
    
    // tri par id de test (ordre naturel)
    $subSubResult = array();
    $keys = array_keys($subResult);
    natsort($keys);
    foreach($keys as $key)
    {
      array_push($subSubResult, $subResult[$key]);    	
    }
    
    
    $this->results = $subSubResult;
  }


  /**
   * Sauvegarde des résultats après édition manuelle
   * 
   * @param sfWebRequest $request
   */
  public function executeEvaluationSauvegarde(sfWebRequest $request)
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
    
    $this->redirect('evaluation', $this->extraction);
  }
}
