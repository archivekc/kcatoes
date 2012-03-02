<?php

/**
 * ihm actions.
 *
 * @package    kcatoes
 * @subpackage ihm
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ihmActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  // gestion des pages web
  public function executeWebPages(sfWebRequest $request)
  {
  	$this->addPageForm = new WebPageForm();
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->addPageForm))
      {
	    	$page = $this->addPageForm->save();
        $this->redirect('ihm/WebPages');
      }
    }

  	
  	$table  = Doctrine_Core::getTable('WebPage');
  	$q = Doctrine_Query::create()
  	 ->from('WebPage')
  	 ->orderBy('updated_at DESC');
  	 
  	 $this->pages = $q->fetchArray();
  	 
  }
  public function executeDeleteWebPage(sfWebRequest $request)
  {
  	$page = Doctrine_Core::getTable('WebPage')->findOneById($request->getParameter('id'));
  	$page->delete();
  	$this->redirect('ihm/WebPages');
  }
  
  public function executeWebPage(sfWebRequest $request)
  {
  	$id = $request->getParameter('id');
  	$this->page = Doctrine_Core::getTable('WebPage')->findOneById($id);
  	$this->evals = Doctrine_Core::getTable('Evaluation')->findByWebPageId($this->page->getId());
  	
  	$this->addEvalForm = new EvaluationForm();
  	$this->addEvalForm->setDefault('web_page_id', $id);
  	
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->addEvalForm))
      {
      	//die(print_r($this->addEvalForm->getValues()));
//      	$evaluation = new Evaluation();
//      	$evaluation->set('web_page_id', $id);
//      	$evaluation->set('config_id', $request->getParameter('config_id'));
//        $evaluation->save();
        $this->addEvalForm->save();
//        $this->redirect('ihm/WebPage?id='.$id);
      }
    }
  	
  }
  
  
  // gestion des conf
  public function executeTestConfigs(sfWebRequest $request)
  {
    $this->addTestConfigForm = new TestConfigForm();
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->addTestConfigForm))
      {
        $testConfig = $this->addTestConfigForm->save();
        $this->redirect('ihm/TestConfigs');
      }
    }

    $table  = Doctrine_Core::getTable('TestConfig');
    $q = Doctrine_Query::create()
     ->from('TestConfig c')
     ->leftJoin('c.CollectionTests')
     ->orderBy('c.updated_at DESC');
     
     $this->configs = $q->fetchArray();
     
  }
  
  public function executeTestConfig(sfWebRequest $request)
  {
  	testUtils::getRequired();
  	$this->config = Doctrine_Core::getTable('TestConfig')->findOneById($request->getParameter('id'));
  }
  
  public function executeEditTestConfig(sfWebRequest $request)
  {
    testUtils::getRequired();
    $this->availableTests = testUtils::getAllTests();

    $this->config = Doctrine_Core::getTable('TestConfig')->findOneById($request->getParameter('id'));
    
    if ($request->isMethod('post'))
    {
      	$collection = $this->config->getCollectionTests();
        $collection->delete();
        
        foreach($request->getParameter('tests') as $test)
        {
        	$item = new TestConfigDetail();
        	$item->setClass($test);
        	$collection->add($item);
        	$this->config->save();
        }
        $this->redirect('ihm/TestConfigs');
    }
    

    $this->selectedTests = array();
    foreach ($this->config->getCollectionTests() as $test)
    {
      $this->selectedTests[] = $test['class'];
    }
  }
  
  public function executeDeleteTestConfig(sfWebRequest $request)
  {
    $config = Doctrine_Core::getTable('TestConfig')->findOneById($request->getParameter('id'));
    $config->delete();
    $this->redirect('ihm/TestConfigs');
  }
  
  /**
   * Valide les données saisies dans un formulaire
   *
   * @param sfWebRequest $request La requête contenant les données à valider
   * @param sfForm       $form    Le fomulaire à valider
   */
  private function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );
    return $form->isValid();
  }
}
