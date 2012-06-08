<?php
/**
 * pages actions.
 *
 * @package    kcatoes
 * @subpackage page
 * @author     cfabby
 */
class scenarioActions extends kcatoesActions
{

	
  public function executeIndex(sfWebRequest $request)
  {
    // formulaire d'ajout d'une pages web
    $this->addScenarioForm = new ScenarioForm();
    
    // soumission
    if ($request->isMethod('post'))
    {
      // Pages web
      if ($this->processForm($request, $this->addScenarioForm))
      {
      	$scenario = $this->addScenarioForm->save();
      	$tplId = trim($this->addScenarioForm->getValue('template'));
      	
      	if ( $tplId != '')
      	{
      		$tpl = Doctrine::getTable('ScenarioTemplate')->findOneById($tplId);
      		$pages = $tpl->getCollectionPages();
      		foreach ($pages as $page)
      		{
      			$scenarioPage = new ScenarioPage();
      			$scenarioPage->setScenarioId($scenario->getId());
      			$scenarioPage->setNom($page->getNom());
      			$scenarioPage->setRequired($page->getRequired());
      			$scenarioPage->save();
      		}
      	}
        //$this->redirect('scenario/index');
      }
    }
    // Scenarios
    $q = Doctrine_Query::create()
     ->from('Scenario s')
     ->leftJoin('s.ScenarioPages')
     ->orderBy('updated_at DESC');
     
    $this->scenarii = $q->execute();
  }

  
  /**
   * Page des modèles de scenario
   * Enter description here ...
   * @param $request
   */
  public function executeTemplateIndex($request)
  {
    // Scenarios modeles
    $q = Doctrine_Query::create()
     ->select('s.id, s.nom, st.nom, st.required')
     ->from('ScenarioTemplate s')
     ->leftJoin('s.CollectionPages st')
     ->orderBy('updated_at DESC');
     
    $this->scenarioTemplates = $q->fetchArray();
  }
  
  /**
   * Suppression d'un  modele scenario
   * @param sfWebRequest $request
   */
  public function executeTemplateDelete(sfWebRequest $request)
  {
    $this->getRoute()->getObject()->delete();
    $this->redirect('scenario/templateIndex');
  }
  
  /**
   * Détail d'un scenario
   * @param sfWebRequest $request
   */
  public function executeDetail(sfWebRequest $request)
  {
    $this->scenario = $this->getRoute()->getObject();
    $this->addPageForm = new ScenarioPageForm();
    
    $this->setAsTemplateForm = new ScenarioTemplateForm();
    
    $this->pages = $this->scenario->getScenarioPagesInfo();
    
    // soumission
    if ($request->isMethod('post'))
    {
    	$parameters = $request->getParameterHolder(); 
    	if ($parameters->get('scenarioPage', false))
    	{
    		// soumission d'une page web
	      if ($this->processForm($request, $this->addPageForm))
	      {
	        $page = $this->addPageForm->save();
	        $page->setScenario($this->scenario);
	        $page->save();
	        $this->redirect('scenarioDetail', $this->scenario);
	      }
    	}
    	if ($parameters->get('scenarioTemplate', false))
    	{
        // soumission d'un modele
        if ($this->processForm($request, $this->setAsTemplateForm))
        {
        	  $scenarioTemplate = $this->setAsTemplateForm->save();
        	  foreach($this->scenario->getScenarioPages() as $page){
        	  	$templatePage = new scenarioTemplatePage();
        	  	$templatePage->setNom($page->getNom());
        	  	$templatePage->setRequired($page->getRequired());
        	  	$templatePage->setScenarioTemplateId($scenarioTemplate->getId());
        	  	$templatePage->save();
        	  }
//          $page = $this->addPageForm->save();
//          $page->setScenario($this->scenario);
//          $page->save();

          $this->redirect('scenarioDetail', $this->scenario);
        }
    	}
    }
  }
  
  
  /**
   * Modification d'un scenario
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->scenario = $this->getRoute()->getObject();
    
    $this->editScenarioForm = new ScenarioForm($this->scenario);
    
    // formulaire d'ajout d'une pages web
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->editScenarioForm))
      {
      	$this->editScenarioForm->save();
        $this->redirect('scenario/index');
      }
    }
  }

  /**
   * Modification d'une page de scenario
   * @param sfWebRequest $request
   */
  public function executePageEdit(sfWebRequest $request)
  {
    $this->page = $this->getRoute()->getObject();
    
    $this->editPageForm = new ScenarioPageForm($this->page);
    
    // formulaire d'ajout d'une pages web
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->editPageForm))
      {
        $this->editPageForm->save();
        $this->redirect('scenarioDetail', $this->page->getScenario());
      }
    }
  }
  
  
  public function executePageDelete(sfWebRequest $request)
  {
  	$this->getRoute()->getObject()->delete();
  	$this->redirect('scenarioDetail', array('id' => $request->getParameter('scenarioId')));
  }

  
  /**
   * Suppression d'un scenario
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
    $this->getRoute()->getObject()->delete();
    $this->redirect('scenario/index');
  }
  
  /**
   * Actions
   * @param sfWebRequest $request
   */
  public function executeActions(sfWebRequest $request)
  {
  	//$this->scenario = Doctrine::getTable('scenario')->findOneById($request->getParameter('id'));
  	$scenario = $this->getRoute()->getObject();
  	$scenarioAction = $request->getParameterHolder()->get('scenarioAction');
  	$extractIds = $request->getParameterHolder()->get('extracts');
  	
    $this->getUser()->setFlash('extractIds', $extractIds);
    
  	switch($scenarioAction)
  	{
  		case 'rapport_simple':
  			$this->redirect('resultatScenario', array( 'id'   => $scenario->getId(), 
  			                                           'mode' => 'simple'));
  			break;
  			
  		case 'rapport_detaille':
  			$this->redirect('resultatScenario', array( 'id'   => $scenario->getId(), 
  			                                           'mode' => 'riche'));
  			break;
  			
  		case 'execute_test':
  			$this->actionTitle = 'Tests';
  			
  	    $ajax = $request->getParameter('ajax');
        if ($ajax)
        {
          // Requête AJAX

          // Retourne l'état actuel de l'exécution (FIXME)
          echo json_encode(array('executes'=>1, 'total'=>10));
          return sfView::NONE;
        }
        else 
        {
    			// Programme la redirection
    			// false en 2eme paramètre pour éviter une double redirection
    			$this->getUser()->setFlash('redirectTo', 'scenarioDetail'                      , false);
    			$this->getUser()->setFlash('redirectParams', array('id' => $scenario->getId()) , false);
    			
    			$this->forward('eval', 'executeTests');
        }
  			break;
  			
  		default:
  			$this->actionTitle = 'Action non prévue';
  	}
  }
  
  /**
   * Exécution d'un tir de tests (limité dans le temps)
   * @param sfWebRequest $request
   */
  public function executeLaunch(sfWebRequest $request)
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
      
      // Exécution du prochain test
      // TODO : à faire dans un try{} (il faut impérativement capturer toutes les erreurs 
      // pour retourner toujours la sortie en JSON)
      
      // Instanciation du wrapper
      $extract = $extracts[$extractionIndex];
      $test = $allTests[$testsIndex];
      $kcatoes = new KcatoesWrapper(array($test), $extract->getSrc());

      // Lancement du prochain test
      // TODO : factoriser (intégrer à quelque chose dans /lib/, KCatoesWrapper ou autre)
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
      
      // Calcul du temps d'exécution
      $timeEnd = microtime(true);
      $timeTotal += ($timeEnd - $timeStart) * 1000000;
      
      // Mise à jour du compteur
      $currentIndex++;
    }
    
    // Retour du résultats
    echo json_encode(array('executes'=>$currentIndex, 'total'=>$total));
    
    return sfView::NONE;
  }
  
  	
  

}