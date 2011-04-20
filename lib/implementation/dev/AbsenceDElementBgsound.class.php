<?php

/**
 * Compte le nombre d'élément bgsound de la page.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDElementBgsound extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $bgsounds = $page->crawler->filter('bgsound');

    foreach ($bgsounds as $bgsound)
    {
      $this->complements[] = new Complement(
        $this->getSourceCode($bgsound),
        $this->getXPath($bgsound),
        'La balise bgsound ne devrait pas être présente dans la page'
      );
    }

    return (count($bgsounds) == 0) ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}