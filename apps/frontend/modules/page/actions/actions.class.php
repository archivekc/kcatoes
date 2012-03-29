﻿<?php

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
	        $src = utf8_encode(file_get_contents($url));
	        
	        // recupérer le doctype
	        $doctype = null;
	      
	        $matches = array();
	        $pattern = '/(<!DOCTYPE[^>]*>)/i';
	        preg_match($pattern, $src, $matches);
	      
	        if (isset($matches[1]) && $matches[1] != '') {
	          $doctype = $matches[1];
	        }
        	
        	$page->setDoctype($doctype);
        	
          // $page->setBasesrc($src)->save();
          
          // Enregistrement de la base
          
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

	public function executeDetail(sfWebRequest $request)
	{
    $this->page = $this->getRoute()->getObject();

    $this->allTests = TestsHelper::getAllTestsFromDir();

    // Formulaire listant les tests disponibles
    $this->testsForm = new WebPageTestsForm($this->page);
    
	}
	
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
}