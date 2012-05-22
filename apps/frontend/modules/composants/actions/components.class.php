<?php
class composantsComponents extends sfComponents
{
    public function executeMenuDisplay(sfWebRequest $request)
    {
    	$this->mName = $request->getParameter('module');
    	$this->aName = $request->getParameter('action');
    	
    	//$this->actionName = $this->getActionName();
    	$this->toto = 'tata';
    }
}