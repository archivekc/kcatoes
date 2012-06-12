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
          $source = $this->addPageForm->getValue('src');
          $page->doExtract($source);
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
	 * wizard d'extraction du code source de la page
	 */
  public function executeExtractWizard(sfWebRequest $request)
  {
    $this->page = $this->getRoute()->getObject();
    
    $this->extracts = $this->page->getCollectionExtracts();
    
    $addExtract = new WebPageExtract();
    $addExtract->setWebPageId($this->page->getId());
    
    
    // soumission
    if ($request->isMethod('post'))
    {
    	$this->addExtractForm = new addExtractForm();
    	if ($this->processForm($request, $this->addExtractForm))
      {
      	$extract;
      	if (gettype($extract = $this->page->getJsExtract()) == 'object')
      	{
      		$this->addExtractForm->getValue('src');
      		$extract->setSrc($this->addExtractForm->getValue('src'));
      	}
      	else
      	{
	      	$extract = $this->addExtractForm->getObject();
      		$extract->setType('Avec JavaScript');
      		$extract->setSrc($this->addExtractForm->getValue('src'));
      		$extract->setWebPageId($this->page->getId());
      	}
      	$extract->save();
      	$this->redirect('pageExtracts' ,array('id'=>$this->page->getId()));
      }
    } else {
	    $this->addExtractForm = new addExtractForm($addExtract);
    }  
  }
  
  /**
   * 
   */
  public function executeExtractSrc(sfWebRequest $request)
  {
  	$extract = $this->getRoute()->getObject();
  	$baseUrl = $extract->getWebPage()->getUrl();
  	$this->src = $extract->getSrc();
  	
  	$this->src = preg_replace('#(<head[^>]*>)#i', "$1".'<base href="'.$baseUrl.'"></base>', $this->src);
  	
  	$this->setLayout(false);
  }

  /**
   * Affichage de la page originale 
   * @param $request
   */
  public function executeSource(sfWebRequest $request)
  {
    $this->extraction = $this->getRoute()->getObject();
    
    sfConfig::set('sf_web_debug', false);
    
    $baseUrl = $this->extraction->getWebPage()->getUrl();
    
    // Ajout de <base ... /> pour affichage dans une iframe
    $this->source = preg_replace('#(<head[^>]*>)#i', "$1".'<base href="'.$baseUrl.'"/>', 
                                 $this->extraction->getSrc());
    
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
  public function executeConfigurationTests(sfWebRequest $request) 
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
  public function executeExecutionTests(sfWebRequest $request)
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
      
      // Enregistrement des résultats
      $result = new TestResult();
      $result->saveResult($this->extraction, $resTest);
      
    }
    
    // Vers les résultats
    //$this->redirect('evaluationSimple', $this->extraction);
    //$this->redirect('evaluation', $this->extraction);
    $this->redirect('pageDetail', $this->page);
    
  }
  
}
