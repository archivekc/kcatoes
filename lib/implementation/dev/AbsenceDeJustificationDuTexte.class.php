<?php

/**
 * Compte le nombre d'éléments de la page utilisant la propriété d'alignement
 * de texte justify.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Coeut
 *
 */
class AbsenceDeJustificationDuTexte extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $count = 0;
    $crawler = $page->crawler;
    $elements = $crawler->filter('*')->extract(array('align', 'style'));
    foreach ($elements as $element)
    {
      if ($element[0] == 'justify' || preg_match('#justify#', $element[1]))
      {
        $count++;
      }
    }

    $this->explication .= $count.' bloc(s) de texte justifié(s)';
    return ($count == 0);
  }
}