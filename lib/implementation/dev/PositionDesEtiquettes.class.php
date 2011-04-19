<?php

/**
 * Ce teste regroupe les champs de saisie présents dans la page pour permettre à
 * un testeur de vérifier que pour ceux dont un segment de texte sert d'étiquette,
 * celui ci est situé de façon à pouvoir leur être associé visuellement.
 *
 * @author Adrien Couet
 *
 */
class PositionDesEtiquettes extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $champs = $page->crawler->filter('input[type=text], input[type=password],
                                      input[type=file], input[type=radio],
                                      input[type=checkbox], textarea, select');
    foreach ($champs as $champ)
    {
      $reussite = false;
      $this->echecs[] = new Echec($this->getSourceCode($champ),
                                  $this->getXPath($champ),
                                  'Si un segment de texte sert d\'étiquette à '.
                                  'ce champ, vérifier qu\'il est positionné de'.
                                  ' façon à pouvoir lui être associé visuellement');
    }
    return $reussite;
  }
}