<?php

/**
 * Compte le nombre d'éléments de formulaire de la page n'ayant ni un attribut
 * title ni un attribut id renseigné et unique.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
use Symfony\Component\DomCrawler\Crawler;
class AbsenceDElementDeFormulaireSansIdentifiant extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }
  public function execute(Page $page)
  {
    $count = 0;
    $crawler = $page->crawler;
    $filedId = array();
    $nombres = array();
    $elements = new Crawler();
    $formulaire = $crawler->filter('input[type=text][id], input[type=password][id],
                              input[type=file][id], input[type=radio][id],
                              input[type=checkbox][id], textarea[id], select[id]');
    foreach ($formulaire as $node)
    {
      if (!$node->hasAttribute('title') || $node->getAttribute('title') == '')
      {
        $elements->add($node);
      }
    }
    $ids = $elements->extract('id');
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
