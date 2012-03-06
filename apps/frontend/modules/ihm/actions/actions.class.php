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
  
  
  
  /**
   * Affichage de la liste des WebPage
   * @param sfWebRequest $request
   */
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
  
  /**
   * Suppression d'une WebPage
   * @param sfWebRequest $request
   */
  public function executeDeleteWebPage(sfWebRequest $request)
  {
  	$page = Doctrine_Core::getTable('WebPage')->findOneById($request->getParameter('id'));
  	$page->delete();
  	$this->redirect('ihm/WebPages');
  }
  
  /**
   * Affichae d'une WebPage 
   * @param sfWebRequest $request
   */
  public function executeWebPage(sfWebRequest $request)
  {
  	$id = $request->getParameter('id');
  	$this->page = Doctrine_Core::getTable('WebPage')->findOneById($id);
  	
  	$this->configs = $this->page->getCollectionTestConfig();

    $this->addConfigForm = new Assoc_WebPage_TestConfigForm();
    $this->addConfigForm->setDefault('web_page_id', $id);
    
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->addConfigForm))
      {
        $this->addConfigForm->save();
        $this->redirect('webPage', array('id' => $id));
      }
    }
  }
  
  /**
   * Suppression d'une association WebPage - TestConfig
   * @param sfWebRequest $request
   */
  public function executeWebPageDeleteConfigTest(sfWebRequest $request){
  	
    // Récupération de l'objet Assoc_WebPage_TestConfig
    $testAssoc = $this->getRoute()->getObject();
    
    // Suppression
    $testAssoc->delete();
          
    // Redirection vers la fiche de la page web
    $web_page_id = $request->getParameter('web_page_id');
    $this->redirect('ihm/WebPage?id='.$web_page_id);
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
  	TestsHelper::getRequired();
  	$this->config = Doctrine_Core::getTable('TestConfig')->findOneById($request->getParameter('id'));
  }
  
  public function executeEditTestConfig(sfWebRequest $request)
  {
    TestsHelper::getRequired();
    $this->availableTests = TestsHelper::getAllTestsFromDir();

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
   * Lancement des testds liés à une page
   * @param $request
   * @return 
   */
  public function executeLaunchTests(sfWebRequest $request){
      
    // Récupération de l'objet Assoc_WebPage_TestConfig
    $testAssoc = $this->getRoute()->getObject();

    // Récupère la page
    $this->page       = $testAssoc->getWebPage();
    $this->testConfig = $testAssoc->getTestConfig();

    // Récupère la liste des tests à lancer 
    $this->tests = $testAssoc->getTestConfig()->getCollectionTests();

    // Récupère la liste de tests disponibles
    $this->allTests = TestsHelper::getAllTestsFromDir();
    
    // Rangement des tests
    $this->tab_tests = array();
    $this->listeIds = array();
    foreach ($this->tests as $t){
      array_push($this->listeIds, $t->getClass());
      array_push($this->tab_tests, array(
        'class'      => $t->getClass(),
        'implemente' => in_array($t->getClass(), $this->allTests)
      ));
    }

    // Inclusion des classes
    TestsHelper::getRequired();    
    
    // Exécution des tests
    $options = array(
      'url'     => $this->page->getUrl(),
      'html'    => null,
      'output'  => 'rich',
      'history' => true
    );
    
    // Fonction commune app/task
    $kcatoes = KcatoesWrapper::execute($this->listeIds, $options, 'action', $this->page, $this->testConfig);
    
    $this->resultUrlRoot = '/output/'.
                           $kcatoes->getExportPath('relative', 'web', $this->page, $this->testConfig);
    
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
