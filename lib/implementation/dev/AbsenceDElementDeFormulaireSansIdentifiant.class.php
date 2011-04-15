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
    $resultat = true;
    $crawler = $page->crawler;
    $ids = array();

    $formulaire = $crawler->filter('input[type=text], input[type=password],
                              input[type=file], input[type=radio],
                              input[type=checkbox], textarea, select');

    foreach ($formulaire as $node)
    {
      if (!$node->hasAttribute('title') || $node->getAttribute('title') == '')
      {
        if(!$node->hasAttribute('id'))
        {
          $this->echecs[] = new Echec($this->getSourceCode($node),
                                      $this->getXPath($node),
                                      'Cet élément n\'a pas d\'attribut id ni d\'attribut title renseigné');
          $resultat = false;
        }
        else
        {
          $id = $node->getAttribute('id');
          $occurences = $crawler->filter('[id='.$id.']');
          if (count($occurences) > 1)
          {
            $this->echecs[] = new Echec($this->getSourceCode($node),
                                        $this->getXPath($node),
                                        'Cet élément n\'a pas d\'attribut title renseigné et son attribut id n\'est pas unique');
            $resultat = false;
          }
        }
      }
    }
    return $resultat;
  }
}
