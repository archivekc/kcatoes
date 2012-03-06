<?php

/**
 * Compte le nombre d'éléments de formulaire de la page n'ayant ni un attribut
 * title ni label associé.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
use Symfony\Component\DomCrawler\Crawler;
class AbsenceDElementDeFormulaireSansEtiquetteAssociee extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $count = 0;
    $crawler = $page->crawler;
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
    $ids = $elements->each(function ($node, $i)
    {
      return $node->attributes->getNamedItem('id')->nodeValue;
    });
    foreach($ids as $id)
    {
      $labels = $crawler->filter('label[for='.$id.']');
      if (count($labels) != 1)
      {
        $count++;
      }
    }
    $this->explication .= $count.' élément(s) de formulaire sans attribut title ou sans label associé';
    return ($count == 0);
  }
}