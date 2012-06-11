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
    
    
    $testOut = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'pendingTesting'.DIRECTORY_SEPARATOR.$this->scenario->getId();
    $testDone = $testOut.'DONE';
    
    clearstatcache($testOut);
    clearstatcache($testDone);
    
    if (file_exists($testOut) && file_exists($testDone))
    {
    	unlink($testOut);
    	unlink($testDone);
    }
    
    clearstatcache($testOut);
    clearstatcache($testDone);
    
    $this->pendingTesting = file_exists($testOut);
    
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

  public function executeAvancement(sfWebRequest $request)
  {
  	$scenario = $this->getRoute()->getObject();
  	$testOut = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'pendingTesting'.DIRECTORY_SEPARATOR.$scenario->getId();
  	$testDone = $testOut.'DONE';
  	
  	if (!file_exists($testDone))
  	{
  		$this->getResponse()->addHttpMeta('refresh','1', false);
  	}
  	
  	$this->count = strlen(file_get_contents($testOut));

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
		
        $ajax = $request->getParameter('ajax');
        
        // Requête AJAX
        if ($ajax)  
        {
          $this->forward('eval', 'executionTests');
        }
        // Processus en tâche de fond
        else 
        {
          $this->actionTitle = 'Tests';
          
          $extracts = implode(',', $extractIds);
          $scenarioId = $scenario->getId();
          
          $args = 'sId='.$scenarioId.' eIds='.$extracts;
          $scriptPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'test.php';
          
          $outPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'pendingTesting'.DIRECTORY_SEPARATOR.$scenarioId;
          
          
          if (substr(php_uname(), 0, 7) == "Windows"){
            // see: http://de2.php.net/manual/en/function.exec.php#35731
            //var_dump("start \"tests\" \"" . $scriptPath . "\" " . $args.' > '.$outPath);die();
            //pclose(popen("start \"tests\" \"" . $scriptPath . "\" " . $args.' > '.$outPath, "r"));
    
            //var_dump("/B start  start php \"tests\" \"" . $scriptPath .'" >> "'.$outPath.'"');die();
            $WshShell = new COM("WScript.Shell");
            $oExec = $WshShell->Run("cmd /C php \"" . $scriptPath .'" '.$args.' > "'.$outPath.'"  ', 0, false);
            //popen(pclose("cmd php \"" . $scriptPath .'" '.$args.' > "'.$outPath.'"  '),'r');
      
          }
          else
          {
            exec($scriptPath . " " . $args . ' >'.$outPath.'&');   
          } 
          
          //pclose(popen("start \"bla\" \"" . $exe . "\" " . escapeshellarg($args), "r")); 
          //exec('php '.$scriptPath.' '.$args.' >'.$outPath.'&');
          
          $this->redirect('scenarioDetail', $scenario);
      
      
      
      
          
        }
      break;

    
    default:
      $this->actionTitle = 'Action non prévue';
    }
  }
  
  public function executeTest(sfWebRequest $request)
  {

  }
  
  public function executeAction(sfWebRequest $request){
  	echo exec('php '.dirname(__FILE__).'/test.php >'.dirname(__FILE__).'/../templates/testViewSuccess.php&');
  }

  public function executeTestView(sfWebRequest $request){
  	$this->refresh = 2;
  	$this->getResponse()->addHttpMeta('refresh','1', false);
  }
}