<?php

/**
 * Gestionnaire de tests de KCatoes
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class Tester
{
  private $tests;
  private $resTests;
  private $page;
  private $logger;

  /**
   * Créé un testeur à partir d'une page web et d'une liste de tests
   * qui lui seront appliqués
   *
   * @param Page     $_page   Page sur laquelle sont exécutés les tests
   * @param array    $ids     Liste des ids des tests à exécuter
   * @param sfLogger $_logger Le logger à utiliser
   */
  public function __construct(Page $_page, $testsClass, sfLogger $_logger = null)
  {
    $this->page   = $_page;
    $this->tests  = $testsClass;
    $this->logger = $_logger;
    $this->resTests = array();
  }

  /**
   * Exécute les tests spécifiés lors de la création du tester
   *
   * @tested
   */
  public function executeTest()
  {
  	foreach ($this->tests as $class) {
  		$test = new $class();
  		$test->execute($this->page);
  		array_push($this->resTests,$test);
  	}
  	return;
  	
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
   * Exporte le résultat des tests au format CSV
   *
   *@return string correspondant au fichier CSV
   */
  public function toCSV()
  {

    $header = array(
      'testId'    => 'Id du test'
      ,'nom'      => 'Nom'
      ,'main'     => 'Statut global'
      ,'proc'     => 'Procédure de test'
      ,'statut'   => 'Statut'
      ,'xpath'    => 'XPath'
      ,'source'   => 'Code source'
      ,'comment'  => 'Commentaire' 
    );
    
    $file = fopen('php://temp', 'w');
    fputcsv($file, $header, ';', '"');
    
  	foreach ($this->resTests as $test)
  	{
  		$testInfo = $test->getTestResults();
  		
  		foreach ($testInfo as $resultLine)
  		{
        $line = array(
		      'testId'    => $test::testId
		      ,'nom'      => $test::testName
		      ,'main'     => Resultat::getLabel($test->getMainResult())
		      ,'proc'     => $test::testProc
		      ,'statut'   => Resultat::getLabel($resultLine['result'])
		      ,'xpath'    => $resultLine['xpath']
		      ,'source'   => $resultLine['source']
		      ,'comment'  => $resultLine['comment']
		    );
        fputcsv($file, $line, ';', '"');
  		} 
  	}
  	rewind($file);
  	$output = stream_get_contents($file);

  	fclose($file);
  	return $output;
  }
  
  /**
   * Exporte le résultat des tests au format HTML
   *
   *@return string correspondant au fichier HTML
   */
  public function toHTML()
  {
  	$output = '<table id="kcatoesRapport"><thead><tr>';

  	// entête
  	$output .= '<th scope="col">Id du test</th>';
  	$output .= '<th scope="col">Nom</th>';
  	$output .= '<th scope="col">Statut global</th>';
  	$output .= '<th scope="col">Procédure de test</th>';
  	$output .= '<th scope="col">Statut</th>';
  	$output .= '<th scope="col">Code source</th>';
  	$output .= '<th scope="col">XPath</th>';
  	$output .= '<th scope="col">Commentaire</th>';
  	
  	$output .= '</tr></thead><tbody>';
  	
  	// corps
    foreach ($this->resTests as $test)
    {
    	$testInfo = $test->getTestResults();
    	$nbLigne = $rowspan = count($testInfo);
    	if ($nbLigne <=1 )
    	{
    		$rowspan = '';
    	}
    	else
    	{
    		$rowspan = 'rowspan="'.$nbLigne.'"';
    	}
    	
      $output .= '<tr class="'.Resultat::getCode($test->getMainResult()).'">';
      $output .= '<th '.$rowspan.' class="testId">'.$test::testId.'</th>';
      $output .= '<td '.$rowspan.' class="testName">'.$test::testName.'</td>';
      $output .= '<td '.$rowspan.' class="testStatus">'.Resultat::getLabel($test->getMainResult()).'</td>';
      $output .= '<td '.$rowspan.' class="testProc">'.$test::testProc.'</td>';
      
      if ($nbLigne == 0)
      {
      	$output .= '<td colspan="4"></td></tr>';
      }
      else
      {
	      $first = true;
	      foreach ($testInfo as $resultLine)
	      {
	      	if (!$first)
	      	{
	      		$output .= '<tr>';
	      	}
      		$first = false;

	      	$output .= '<td class="subResult '.Resultat::getCode($resultLine['result']).'">'.Resultat::getLabel($resultLine['result']).'</td>';
	      	if (strlen($resultLine['source']))
	      	{
		      	$output .= '<td class="source"><pre>'.htmlentities($resultLine['source']).'</pre></td>';
	      	}
	      	else
	      	{
	      		$output .= '<td class=""></td>';
	      	}
	      	$output .= '<td class="xpath">'.$resultLine['xpath'].'</td>';
	      	$output .= '<td class="comment">'.$resultLine['comment'].'</td>';
	      	
	        $output .= '</tr>';
	      }
      }
      
    }
  	
  	$output .= '</tbody></table>';
  	return $output;
  }
  
  /**
   * Exporte le résultat des tests au format JSON
   *
   *@return string correspondant au fichier JSON
   */
  public function toJSON()
  {
  	$output = array();
    foreach ($this->resTests as $test)
    {
    	$subResult = array();
    	foreach ($test->getTestResults() as $sub)
    	{
    		array_push($subResult, array(
          'statut'   => Resultat::getLabel($sub['result'])
          ,'xpath'    => $sub['xpath']
          ,'source'   => $sub['source']
          ,'comment'  => $sub['comment']
    		));
    	}
    	
      array_push($output, array(
       'testId'    => $test::testId
       ,'nom'      => $test::testName
       ,'main'     => $test->getMainResult()
       ,'proc'     => $test::testProc
       ,'results'  => Resultat::getLabel($subResult)
      ));
    }
    return json_encode($output);
  }
  
  /**
   * Retourne la liste des tests sélectionnés dans $this->tests
   * Utilisé par les tests unitaires
   *
   */
  public function getTests()
  {
    $tests = array();
    foreach ($this->tests as $test)
    {
      $tests[] = $test;
    }
    return $tests;
  }

}