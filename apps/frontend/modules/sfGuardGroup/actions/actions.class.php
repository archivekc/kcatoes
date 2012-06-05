<?php


/**
 * sfGuardGroup actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage sfGuardGroup
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 31002 2010-09-27 12:04:07Z Kris.Wallsmith $
 */
class sfGuardGroupActions extends autoSfGuardGroupActions
{
  public function executeAssocTest(sfWebRequest $request)
  {
  	$this->profil = $this->getRoute()->getObject();
  	$this->allTests = TestsHelper::getAllTestsById();
  	//var_dump($this->allTests);die();
  	
  	// Formulaire listant les tests disponibles
    $this->testsForm = new ProfilTestForm($this->profil);

    // formulaire d'ajout de tests
    if ($request->isMethod('post'))
    {
      if ($this->processCustomForm($request, $this->testsForm))
      {
        // Suppression des tests associés existants
        // TODO : optimiser : ne passer qu'une seule requête
        foreach($this->profil->getCollectionTests() as $test) 
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
            $test = new ProfilTest();
            $test->setProfilId($this->profil->getId());
            $test->setClass($key);
            $test->save();
          }
        }
        
        $this->getUser()->setFlash('profilTestsMsg', 'Tests enregistrés');
		    $this->redirect('sf_guard_group_assoc_test', array('id'=> $this->profil->getId()));
      }
    }
  	
  }
  
  protected function processCustomForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );

    return $form->isValid();
  }
  
  
}
