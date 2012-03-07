<?php

/**
 * Vérifie la présence d'au moins un titre de premier niveau hiérarchique (h1)
 * dans la page
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class PresenceDAuMoinsUnTitreDePremierNiveauH1 extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $h1 = $page->crawler->filter('h1');

    if (!(count($h1) > 0))
    {
      $this->complements[] = new Complement('', '', 'La page ne contient pas de titre de hiérarchie de premier niveau (h1)');
      $reussite = false;
    }
    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}