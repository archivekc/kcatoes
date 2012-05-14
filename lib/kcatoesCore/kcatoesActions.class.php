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
}