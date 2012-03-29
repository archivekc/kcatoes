<?php

/**
 * pages actions.
 *
 * @package    kcatoes
 * @subpackage page
 * @author     cfabby
 */
class pageActions extends sfActions
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
          $page->setBasesrc($src)->save();
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
  
  public function executeDelete(sfWebRequest $request)
  {
  	$this->page = $this->getRoute()->getObject()->delete();
  	$this->redirect('page/index');
  }
}
