<?php

/**
 * Ce test regroupe les formulaires présent dans la page pour permettre à un
 * tester de vérifier que ceux soumis à un contrôle de saisie indiquent quels
 * sont les champs erronés et, si nécessaire, si une information sur le format
 * ou le type de saisie attendu est présente.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class IndentificationDesErreursDeSaisie extends ASource
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
        ' traitement, vérifier que les champs erronés sont indiqués et si '.
        'nécessaire si une information sur le format ou le type de saisie '.
        'attendu est présente'
      );
      $reussite = false;
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}