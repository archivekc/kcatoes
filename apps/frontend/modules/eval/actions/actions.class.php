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
    $_SERVER['rubrique'] = 'eval';
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
   * Affichage de la page originale 
   * TODO CFA: remove et remplacer l'utilisation par executeExtractSrc
   * @param $request
   */
  public function executeSource(sfWebRequest $request)
  {
    $this->extraction = $this->getRoute()->getObject();
    $doctype = $this->extraction->getWebPage()->getDoctype();
    if (is_null($doctype)){
    	$doctype = '';
    }
    $this->source = $doctype.$this->extraction->getSrc();
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
}