<?php
class kcatoesActions extends sfActions
{
	
  /**
   * Valide les données saisies dans un formulaire
   *
   * @param sfWebRequest $request La requête contenant les données à valider
   * @param sfForm       $form    Le fomulaire à valider
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );

    return $form->isValid();
  }

  public function postExecute()
  {
    /*
     * Les variables flash 'redirectTo' et 'redirectParams' doivent être valuées 
     * avec false en 2ème paramètre : setflash('redirectX', false)
     * Sinon, la redirection est effectuée deux fois, ce qui perturbe l'utilisation
     * de variables flash ailleurs. 
     */
    if ($redirectTo = $this->getUser()->getFlash('redirectTo', false))
    {
    	if ($params = $this->getUser()->getFlash('redirectParams', false))
    	{
        $this->redirect($redirectTo, $params);
    	}
    	else
    	{
	    	$this->redirect($redirectTo);
    	}
    }
  }
}