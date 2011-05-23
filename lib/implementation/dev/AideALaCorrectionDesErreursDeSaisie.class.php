<?php

/**
 * Ce test regroupe les formulaires présents dans la page pour permettre à un
 * testeur de vérifier que si un formulaire est soumis à un contrôle de contenu
 * et si des formats ou des types de saisie spécifiques sont attendus alors
 * le procédé de contrôle de saisie indique les formats ou types de saisie
 * attendus ou propose des suggestions de corrections.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class AideALaCorrectionDesErreursDeSaisie extends ASource
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
      $this->complements[] = new Complement(
        $this->getSourceCode($form),
        $this->getXPath($form),
        'Si ce formulaire dispose d\'un contrôle des information saisies avant'.
        ' traitement et si des formats ou types de saisie spécifiques sont '.
        'attendus, vérifier si le procédé de contrôle de saisie indique les '.
        'formats ou types de saisie attendus ou propose des suggestions de '.
        'corrections.'
      );
      $reussite = false;
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}