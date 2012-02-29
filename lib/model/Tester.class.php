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
  		$test = new $class($this->page);
  		$test->execute();
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
   * Exporte le résultat des tests au format HTML avec interface d'évaluation
   *
   *@return string correspondant au fichier HTML
   */
  public function toHTML()
  {
  	$output = '<table><thead><tr>';

  	// entête
  	$output .= '<th scope="col">Id du test</th>';
  	$output .= '<th scope="col">Nom</th>';
  	$output .= '<th scope="col">Statut global</th>';
  	$output .= '<th scope="col">Procédure de test</th>';
  	$output .= '<th scope="col">Doumentation</th>';
  	$output .= '<th scope="col">Statut</th>';
  	$output .= '<th scope="col">Code source</th>';
  	$output .= '<th scope="col">XPath</th>';
  	$output .= '<th scope="col">Sélecteur CSS</th>';
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
    	
      $output .= '<tr>';
      $output .= '<th '.$rowspan.'>'.$test::testId.'</th>';
      $output .= '<td '.$rowspan.'>'.$test::testName.'</td>';
      $output .= '<td '.$rowspan.'>'.Resultat::getLabel($test->getMainResult()).'</td>';
      $output .= '<td '.$rowspan.'>'.$this->arrayToHtmlList($test->getProc(), true).'</td>';
      $output .= '<td '.$rowspan.'>'.$this->arrayToHtmlList($test->getDocLinks(), true).'</td>';
            
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

	      	$output .= '<td>'.Resultat::getLabel($resultLine['result']).'</td>';
	      	if (strlen($resultLine['source']))
	      	{
		      	$output .= '<td><pre>'.htmlentities($resultLine['source']).'</pre></td>';
	      	}
	      	else
	      	{
	      		$output .= '<td class=""></td>';
	      	}
	      	$output .= '<td>'.$resultLine['xpath'].'</td>';
	      	$output .= '<td>'.$resultLine['cssSelector'].'</td>';
	      	$output .= '<td>'.$resultLine['comment'].'</td>';
	      	
	        $output .= '</tr>';
	      }
      }
      
    }
  	
  	$output .= '</tbody></table>';
  	return $output;
  }
  
  /**
   * Permet de convertir en tableau en list html
   */
  private function arrayToHtmlList(array $input, $ordered = false)
  {
  	$list = $ordered?'ol':'ul';
  	$retString = '<'.$list.'>';
  	foreach ($input as $item)
  	{
  		$retString .= '<li>';
  		if (is_array($item)){
  			$retString .= $this->arrayToHtmlList($item, $ordered);
  		} else {
  			$retString .= $item;
  		}
  		$retString .= '</li>';
  	}
  	
  	$retString .= '</'.$list.'>';
  	return $retString;
  }
  
  /**
   * Exporte le résultat des tests au format HTML
   *
   *@return string correspondant au fichier HTML
   */
  public function toRichHTML()
  {
  	include_once sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'geshi'.DIRECTORY_SEPARATOR.'geshi.php';
  	
    $output = '<table id="kcatoesRapport"><thead><tr>';

    // entête
    $output .= '<th scope="col" class="testId">Id du test</th>';
    $output .= '<th scope="col" class="testName">Nom</th>';
    $output .= '<th scope="col" class="testStatus">Statut global</th>';
    $output .= '<th scope="col" class="testProc">Procédure de test</th>';
    $output .= '<th scope="col" class="testDoc">Documentation</th>';
    $output .= '<th scope="col" class="subResult">Statut</th>';
    $output .= '<th scope="col" class="context">Contexte</th>';
    $output .= '<th scope="col" class="comment">Commentaire</th>';
    
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
      $output .= '<td '.$rowspan.' class="testProc">'.$this->arrayToHtmlList($test->getProc(), true).'</td>';
      $output .= '<td '.$rowspan.' class="testDoc">'.$this->arrayToHtmlList($test->getDocLinks(), true).'</td>';
      
      if ($nbLigne == 0)
      {
        $output .= '<td colspan="2"></td></tr>';
      }
      else
      {
        $first = true;
        foreach ($testInfo as $resultLine)
        {
        	$test->getResultContextInfo($resultLine);
          if (!$first)
          {
            $output .= '<tr>';
          }
          $first = false;

          $output .= '<td class="subResult '.Resultat::getCode($resultLine['result']).'">'.Resultat::getLabel($resultLine['result']).'</td>';
          $output .= '<td class="context">';
          
          $output .= '<div class="selectors">';
          $output .= '<strong>Sélecteurs</strong>';
          $output .= '<ul>';
          $output .= '<li>xpath : <span class="xpath">'.$resultLine['xpath'].'</span></li>';
          $output .= '<li>css : <span class="cssSelector">'.$resultLine['cssSelector'].'</span></li>';
          $output .= '</ul>';
          $output .= '</div>';
          
          if (strlen($resultLine['source']))
          {
          	$geshi = new GeSHi($resultLine['source'], 'html4strict');
          	// conf geshi
          	$geshi->set_header_type(GESHI_HEADER_DIV);
          	$geshi->enable_line_numbers(GESHI_NO_LINE_NUMBERS);
          	$geshi->enable_classes(false);
          	$geshi->set_overall_class('htmlSource');
          	$geshi->set_tab_width(4);
          	$geshi->enable_keyword_links(false);
          	
	          $output .= '<div class="source">';
	          $output .= '<strong>Code source</strong>';
            $output .= $geshi->parse_code();
            $output .= '</div>';
          }
          else
          {
            $output .= '<td class=""></td>';
          }
          
          $output .= '</td>';
          $output .= '<td class="comment">'.$resultLine['comment'].'</td>';
          
          $output .= '</tr>';
        }
      }
      
    }
    
    $output .= '</tbody></table>';
    return $output;
  }

  /**
   * Exporte le résultat des tests au format CSV
   *
   *@return string correspondant au fichier CSV
   */
  public function toCSV()
  {
    $header = array(
      'testId'        => 'Id du test'
      ,'nom'          => 'Nom'
      ,'main'         => 'Statut global'
      ,'proc'         => 'Procédure de test'
      ,'doc'          => 'Documentation disponible'
      ,'statut'       => 'Statut'
      ,'xpath'        => 'XPath'
      ,'cssSelector'  => 'Sélecteur CSS'
      ,'source'       => 'Code source'
      ,'comment'      => 'Commentaire' 
    );
    
    $file = fopen('php://temp', 'w');
    fputcsv($file, $header, ';', '"');
    
    foreach ($this->resTests as $test)
    {
      $testInfo = $test->getTestResults();
      
      foreach ($testInfo as $resultLine)
      {
        $line = array(
          'testId'        => $test::testId
          ,'nom'          => $test::testName
          ,'main'         => Resultat::getLabel($test->getMainResult())
          ,'proc'         => implode($test->getProc(true), ', ')
          ,'doc'          => implode($test->getDocLinks(true), ', ')
          ,'statut'       => Resultat::getLabel($resultLine['result'])
          ,'xpath'        => $resultLine['xpath']
          ,'cssSelector'  => $resultLine['cssSelector']
          ,'source'       => $resultLine['source']
          ,'comment'      => $resultLine['comment']
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
       ,'main'     => Resultat::getLabel($test->getMainResult())
       ,'proc'     => $test->getProc()
       ,'doc'      => $test->getDocLinks()
       ,'results'  => $subResult
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