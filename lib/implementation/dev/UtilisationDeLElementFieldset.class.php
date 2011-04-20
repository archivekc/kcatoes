<?php

/**
 * Ce test regroupe les formulaires de la page n'utilisant pas de fieldset.
 * Le tester devra vérifier si les champs du formulaire ne nécessitent pas d'avoir
 * une information commune ajoutée à un groupe de labels ou si un groupe de champs
 * ne peut pas être formé à partir du type d'information attendu
 *
 * @author Adrien Couet
 *
 */
class UtilisationDeLElementFieldset extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $forms = $page->crawler->filter('form');
    foreach ($forms as $form)
    {
      $hasFieldset = false;
      foreach ($form->childNodes as $child)
      {
        $hasFieldset = $hasFieldset || (strtolower($child->nodeName) === 'fieldset');
      }
      if (!$hasFieldset)
      {
        $reussite = false;
        $this->complements[] = new Complement(
          $this->getSourceCode($form),
          $this->getXPath($form),
          'Vérifier si des  groupes de champs ne peuvent pas être formés pour '.
          'apporter une information commune à plusieurs labels ou pour réunir '.
          'des champs par type d\'information attendu'
        );
      }
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}