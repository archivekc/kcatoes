<?php

/**
 * Compte le nombre d'éléments de formulaire de la page n'ayant ni un attribut
 * title ni un attribut id renseigné et unique.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDElementDeFormulaireSansIdentifiant extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }
  //TODO Gérer les cas [title=""]
  public function execute(Page $page)
  {
    $count = 0;
    $crawler = $page->crawler;
    $filedId = array();
    $nombres = array();
    $ids = $crawler->filter('input[type=text]:not([title]), input[type=password]:not([title]),
                             input[type=file]:not([title]), input[type=radio]:not([title]),
                             input[type=checkbox]:not([title]), textarea:not([title]),
                             select:not([title])')->extract('id');
    foreach($ids as $id)
    {
      if ($id == '')
      {
        $count++;
      }
      else
      {
        $filedId[] = $id;
      }
    }
    foreach($filedId as $value)
    {
      $nombres[$value] = ( empty($nombres[$value]) ) ? 1 : $nombres[$value]+1;
    }
    foreach($nombres as $occurence)
    {
      $count += ($occurence > 1) ? $occurence : 0;
    }
    $this->explication .= $count.' élément(s) de formulaire avec un attribut id vide, absent ou non unique';
    return ($count == 0);
  }
}
