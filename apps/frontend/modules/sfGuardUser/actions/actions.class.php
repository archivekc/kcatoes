<?php 
class sfGuardUserActions extends autoSfGuardUserActions
{
  /*public function preExecute()
  {
  	parent::preExecute();
  	$this->getUser()->addCredential('profil');
  }*/
	
	/**
	 * Gère les tests associés spécifiquement à un utilisateur
	 * @param $request
	 */
  public function executeUserTest(sfWebRequest $request)
  {
  	$this->allTests = TestsHelper::getAllTestsById();
  	
  	$guardUser = $this->getUser()->getGuardUser();
    $this->profilTest = $guardUser->getProfilTest();
    $this->userTest = $guardUser->getUserTest();
    
    if ($request->isMethod('post'))
    {
    	$userTest = $request->getParameter('test', array());
      foreach($guardUser->getCollectionTests() as $test) 
      {
        $test->delete();
      }
      
      foreach ($userTest as $class) 
      {
        // Crée le nouveau Test
        $test = new UserTest();
        $test->setUserId($guardUser->getId());
        $test->setClass($class);
        $test->save();
      }
      $this->redirect('userTest');
    }
  }
}