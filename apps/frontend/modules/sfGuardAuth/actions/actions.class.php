<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

class sfGuardAuthActions extends BasesfGuardAuthActions
{
	public function preExecute()
	{
	}
  public function executeNewAction()
  {
    return $this->renderText('This is a new sfGuardAuth action.');
  }



}