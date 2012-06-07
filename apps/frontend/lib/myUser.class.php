<?php

class myUser extends sfGuardSecurityUser
{
	public function __construct(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
	{
		parent::__construct($dispatcher, $storage, $options);
		$this->addCredential('__manageOwnProfil');
	}
}
