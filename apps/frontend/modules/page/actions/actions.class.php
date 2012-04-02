<?php

/**
 * pages actions.
 *
 * @package    kcatoes
 * @subpackage page
 * @author     cfabby
 */
class pageActions extends kcatoesActions
{
	public function executeIndex(sfWebRequest $request)
	{
    // formulaire d'ajout d'une pages web
    $this->addPageForm = new WebPageForm();
    
    // soumission
	  if ($request->isMethod('post'))
    {
      // Pages web
      if ($this->processForm($request, $this->addPageForm))
      {
		    // sauvegarde de la page et de l'extraction de base
        if ($page = $this->addPageForm->save()){
          
	        $url = $this->addPageForm->getValue('url');
	        
	        // récupérer la source
	        $src = file_get_contents($url);
	        
	        // encodage UTF-8
	        //$src = $this->_convert($src);
	        $src = $this->_fix_latin($src);
	        
	        // recupérer le doctype
	        $doctype = null;
	      
	        $matches = array();
	        $pattern = '/(<!DOCTYPE[^>]*>)/i';
	        preg_match($pattern, $src, $matches);
	      
	        if (isset($matches[1]) && $matches[1] != '') {
	          $doctype = $matches[1];
	        }
        	
        	$page->setDoctype($doctype);
        	
          // Enregistrement des sources de base
          $baseExtract = new WebPageExtract();
          $baseExtract->setWebPage($page);
          $baseExtract->setSrc($src);
          $baseExtract->setType('base');
          $baseExtract->save();          
          
        };
        
        $this->redirect('page/index');
      }
      
    }
		
    // Pages web
    $table  = Doctrine_Core::getTable('WebPage');
    $q = Doctrine_Query::create()
     ->from('WebPage p')
     ->leftJoin('p.CollectionExtracts')
     ->orderBy('updated_at DESC');
     
    $this->pages = $q->execute();
	}

  /**
   * Détail d'une page web
   * @param sfWebRequest $request
   */
  public function executeDetail(sfWebRequest $request)
  {
    $this->page = $this->getRoute()->getObject();
    $this->allTests = TestsHelper::getAllTestsById();
    $this->testsForm = new WebPageTestsForm($this->page);
	}
	

  /**
   * Modification d'une page web
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->page = $this->getRoute()->getObject();
    
    $this->editPageForm = new WebPageForm($this->page);
    
    // formulaire d'ajout d'une pages web
    if ($request->isMethod('post'))
    {
	    if ($this->processForm($request, $this->editPageForm))
	    {
	    	$this->page->setDescription($this->editPageForm->getValue('description'));
	    	$this->page->save();
	    	
	    	$this->redirect('page/index');
	    }
    }
  }
  
  /**
   * Suppression d'une page
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$this->page = $this->getRoute()->getObject()->delete();
  	$this->redirect('page/index');
  }
  
  /**
   * Configuration des tests d'une page
   * @param sfWebRequest $request
   */
  public function executeTests(sfWebRequest $request) 
  {
  	$this->page = $this->getRoute()->getObject();

    // Formulaire listant les tests disponibles
    $this->testsForm = new WebPageTestsForm($this->page);

    // formulaire d'ajout de tests
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->testsForm))
      {
        // Suppression des tests associés existants
        // TODO : optimiser : ne passer qu'une seule requête
        foreach($this->page->getCollectionTests() as $test) 
        {
          $test->delete();
        }
        
        // Parcours des résultats
        $values = $this->testsForm->getValues();
        foreach ($values as $key => $val) 
        {
          // S'il s'agit d'une des checkboxes correspondant aux tests
          // et qu'elle est cochée
          if ($key != 'id' && $val) 
          {
            // Crée le nouveau Test
            $test = new Test();
            $test->setWebPageId($this->page->getId());
            $test->setClass($key);
            $test->save();
          }
        }
        
        $this->getUser()->setFlash('webPageTestsMsg', 'Tests enregistrés');
      }
    }
    
  	$this->redirect('pageDetail', $this->page);
  }

  /**
   * Lancement des tests sur une extraction donnée
   * @param sfWebRequest $request
   */
  public function executeExecuteTests(sfWebRequest $request)
  {
    $this->extraction = $this->getRoute()->getObject();
    $this->page       = $this->extraction->getWebPage();
    
    $tests = $this->page->getCollectionTests(); 
    $testsClasses = array();
    foreach($tests as $t)
    {
      array_push($testsClasses, $t->getClass());
    }
    
    // TODO : gérer le cas d'erreur où aucun test n'est lié
    // TODO : voir pour réutilisation de KcatoesWrapper::execute()
    // TODO : améliorer factorisation
    
    // Inclusion des classes de test
    TestsHelper::getRequired();
    
    // Instanciation du wrapper
    $kcatoes = new KcatoesWrapper($testsClasses, $this->extraction->getSrc());
    
    // Lance les tests
    $results  = $kcatoes->run();
    $this->resTests = $kcatoes->getResTests();

    $htmlLog = '';
    
    // Sauvegarde en base
    foreach($this->resTests as $resTest)
    {      
      // Suppression des résultats précédents
      // TODO : optimisation
      $resPrec = $this->extraction->getCollectionResults();
      foreach($resPrec as $r)
      {
        $r->delete();
      }
      
      // Nouvel enregistrement pour le résultat global
      $result = new TestResult();
      $result->setWebPageExtractId($this->extraction->getId());
      $result->setClass(get_class($resTest));
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
        if (is_object($res['node'])) {
          $rLine->setTextContent($res['node']->textContent);
        }
        $rLine->save();
      }
    }
    
    // Vers les résultats
    //$this->redirect('pageResultatTests', $this->extraction);
    //$this->redirect('pageResultatTestsRiche', $this->extraction);
    $this->redirect('pageDetail', $this->page);
    
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
   * @param $request
   */
  public function executeSource(sfWebRequest $request)
  {
    $this->extraction = $this->getRoute()->getObject();
    
    $this->source = $this->extraction->getSrc();
    $baseUrl      = $this->extraction->getWebPage()->getUrl();
    
    $this->source = preg_replace('#(<head[^>]*>)#i', "$1".'<base href="'.$baseUrl.'">', $this->source);
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
   * Fonction de conversion en UTF-8
   * (voir http://fr2.php.net/manual/fr/function.utf8-encode.php)
   * @param string $content
   * @return string
   */
  private function _convert($content)
  {
    if( !mb_check_encoding($content, 'UTF-8')
        || !($content === mb_convert_encoding(mb_convert_encoding($content, 'UTF-32', 'UTF-8' ), 'UTF-8', 'UTF-32'))) {

      $content = mb_convert_encoding($content, 'UTF-8');

      if (mb_check_encoding($content, 'UTF-8')) {
        // log('Converted to UTF-8');
      } else {
        // log('Could not convert to UTF-8');
      }
    }
    return $content;
  }

  /**
   * Correction de l'encodage de certains caractères cp1252 et conversion en UTF-8
   * (voir http://fr2.php.net/manual/fr/function.utf8-encode.php)
   * @param string $input
   * @return string
   */
  private function _fix_latin($input)
  {
    // Pas de conversion si déjà en UTF-8
    if(mb_check_encoding($input,'UTF-8'))
    {
      return $input; 
    }
    
    // Initialisation du tableau de substitution
    for($x=128;$x<256;++$x){
      $byte_map[chr($x)] = utf8_encode(chr($x));
    }
    
    $cp1252_map = array(
      "\x80" => "\xE2\x82\xAC",  // EURO SIGN
      "\x82" => "\xE2\x80\x9A",  // SINGLE LOW-9 QUOTATION MARK
      "\x83" => "\xC6\x92",      // LATIN SMALL LETTER F WITH HOOK
      "\x84" => "\xE2\x80\x9E",  // DOUBLE LOW-9 QUOTATION MARK
      "\x85" => "\xE2\x80\xA6",  // HORIZONTAL ELLIPSIS
      "\x86" => "\xE2\x80\xA0",  // DAGGER
      "\x87" => "\xE2\x80\xA1",  // DOUBLE DAGGER
      "\x88" => "\xCB\x86",      // MODIFIER LETTER CIRCUMFLEX ACCENT
      "\x89" => "\xE2\x80\xB0",  // PER MILLE SIGN
      "\x8A" => "\xC5\xA0",      // LATIN CAPITAL LETTER S WITH CARON
      "\x8B" => "\xE2\x80\xB9",  // SINGLE LEFT-POINTING ANGLE QUOTATION MARK
      "\x8C" => "\xC5\x92",      // LATIN CAPITAL LIGATURE OE
      "\x8E" => "\xC5\xBD",      // LATIN CAPITAL LETTER Z WITH CARON
      "\x91" => "\xE2\x80\x98",  // LEFT SINGLE QUOTATION MARK
      "\x92" => "\xE2\x80\x99",  // RIGHT SINGLE QUOTATION MARK
      "\x93" => "\xE2\x80\x9C",  // LEFT DOUBLE QUOTATION MARK
      "\x94" => "\xE2\x80\x9D",  // RIGHT DOUBLE QUOTATION MARK
      "\x95" => "\xE2\x80\xA2",  // BULLET
      "\x96" => "\xE2\x80\x93",  // EN DASH
      "\x97" => "\xE2\x80\x94",  // EM DASH
      "\x98" => "\xCB\x9C",      // SMALL TILDE
      "\x99" => "\xE2\x84\xA2",  // TRADE MARK SIGN
      "\x9A" => "\xC5\xA1",      // LATIN SMALL LETTER S WITH CARON
      "\x9B" => "\xE2\x80\xBA",  // SINGLE RIGHT-POINTING ANGLE QUOTATION MARK
      "\x9C" => "\xC5\x93",      // LATIN SMALL LIGATURE OE
      "\x9E" => "\xC5\xBE",      // LATIN SMALL LETTER Z WITH CARON
      "\x9F" => "\xC5\xB8"       // LATIN CAPITAL LETTER Y WITH DIAERESIS
    );
    
    // Complément du tableau de substitution avec les caractères chiants
    foreach($cp1252_map as $k=>$v){
      $byte_map[$k]=$v;
    }
  
    // Construction de la regexp
    $ascii_char = '[\x00-\x7F]';
    $cont_byte  = '[\x80-\xBF]';
    $utf8_2     = '[\xC0-\xDF]'.$cont_byte;
    $utf8_3     = '[\xE0-\xEF]'.$cont_byte.'{2}';
    $utf8_4     = '[\xF0-\xF7]'.$cont_byte.'{3}';
    $utf8_5     = '[\xF8-\xFB]'.$cont_byte.'{4}';    
    $nibble_good_chars = "@^($ascii_char+|$utf8_2|$utf8_3|$utf8_4|$utf8_5)(.*)$@s";
    
    // Conversion
    $outstr = '';
    $char   = '';
    $rest   = '';
    while((strlen($input))>0){
      if (1 == preg_match($nibble_good_chars, $input, $match))
      {
        $char    = $match[1];
        $rest    = $match[2];
        $outstr .= $char;
      }
      elseif (1 == preg_match('@^(.)(.*)$@s', $input, $match))
      {
        $char    = $match[1];
        $rest    = $match[2];
        $outstr .= $byte_map[$char];
      }
      $input = $rest;
    }
    return $outstr;
  }
  
}
