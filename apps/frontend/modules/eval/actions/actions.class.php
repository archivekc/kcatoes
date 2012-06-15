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
    // Filtres du formulaire
    $this->filters = array(
       'thematique' => array('value'=>'', 'label' => 'Thématique',
                             'choices' => array(
                                         ''             => '(tous)'
                                        ,'Cadres'       => '1 - Cadres'
                                        ,'Couleurs'     => '2 - Couleurs'
                                        ,'Formulaires'  => '3 - Formulaires'
                                        ,'Images'       => '4 - Images'
                                        ,'Multimedia'   => '5 - Multimedia'
                                        ,'Navigation'   => '6 - Navigation'
                                        ,'Presentation' => '7 - Presentation'
                                        ,'Scripts'      => '8 - Scripts'
                                        ,'Standards'    => '9 - Standards'
                                        ,'Structure'    => '10 - Structure'
                                        ,'Tableaux'     => '11 - Tableaux'
                                        ,'Textes'       => '12 - Textes' ))

      ,'niveau'     => array('value'=>'', 'label' => 'Niveau',
                             'choices' => array(
                                         ''    => '(tous)'
                                        ,'A'   => 'A'
                                        ,'AA'  => 'AA'
                                        ,'AAA' => 'AAA' ))

      ,'resultat'   => array('value'=>'', 'label' => 'Résultat',
                             'choices' => array(
                                         ''         => '(tous)'
                                        ,'REUSSITE' => 'Réussite'
                                        ,'ECHEC'    => 'Echec'
                                        ,'NA'       => 'N/A'
                                        ,'MANUEL'   => 'Manuel'
                                        ,'ERREUR'   => 'Erreur d\'exécution' ))
    );
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
    
    $this->score = ''; // TODO { was: $kcatoes->getScore()*100;) }
    
    $fields = array();
    $fields['select'] = array();
    $fields['textarea'] = array();

    // 
    $this->history = true;
    
    // Champs pour formulaire d'historisation
    $cptLine = -1;
    
    // Récupération des tests accessibles par l'utilisateur
    $this->userTests = $this->getUser()->getGuardUser()->getAllAvailableTests();
    
    // Récupération des valeurs des filtres
    foreach($this->filters as $key => $filter){
      $this->filters[$key]['value'] = $this->getUser()->getFlash($key.'Filter', '');
    }
    
    $this->results = $this->extraction->getCollectionResults();
    $subResult = array();
    
    // Parcours des résultats de l'extraction
    foreach($this->results as $result)
    {
      $test       = $result->getClass();
      $thematique = $test::getGroup('thematique');
      $resultat   = $result->getResult();
      
      $resultFilterValues = array(
         'thematique' => $test::getGroup('thematique')
        ,'niveau'     => $test::getGroup('niveau')
        ,'resultat'   => Resultat::getCode($result->getResult())
      );
      
      // Application des filtres
      $doFilter = false;
      foreach($this->filters as $key => $filter){
        if (   $filter['value'] != ''
            && $filter['value'] != $resultFilterValues[$key] ) {
            $doFilter = true;
        }
      }
      if ($doFilter) { continue; }
      
      // Filtrage des tests accessibles par l'utilisateur
    	if (isset($this->userTests[$result->getClass()]))
    	{
	      $cptLine++;
	      $fields['select'][]   = Tester::computeIdForTest('mainResult_'.$test::testId);
	      $fields['select'][]   = Tester::computeIdForTest('subResult'.$cptLine.'_'.$test::testId);
	      $fields['textarea'][] = Tester::computeIdForTest('annot'.$cptLine.'_'.$test::testId);
	      $subResult[$test::testId] = $result; 
    	}
    }
    
    // Tri par id de test (ordre naturel)
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
    
    if ($request->isMethod('post'))
    {
      // *** Récupération des résultats *actuels* associés à l'extraction
      $results = $this->extraction->getResultsForUpdate();
      
      // *** Parcours des résultats de test
      foreach($results as $result)
      {
        // Réupération du résultat envoyé
        // TODO : test si le paramètre existe ?
        
        // Si le résultat du test courant est fourni dans la requête 
        if ($request->hasParameter('mainResult_'.$result->getId()))
        {
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
      }
      
      // *** Sauvegarde en base
      try
      {
        $results->save();
        $this->getUser()->setFlash('success', 'Résultats enregistrés');
      }
      catch(Exception $e) 
      {
        $this->getUser()->setFlash('error', 'Erreur lors de l\'enregistrement');      
      }

      // *** Gestion du filtrage
      foreach($this->filters as $key => $filter){
        $this->getUser()->setFlash($key.'Filter', $request->getParameter($key.'Filter', ''));
      }
      
    }
    
    $this->redirect('evaluation', $this->extraction);
  }
}
