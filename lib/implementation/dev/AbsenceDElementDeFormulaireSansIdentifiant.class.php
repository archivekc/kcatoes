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
  }

  public function execute(Page $page)
  {
    $reussite = true;
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
          $this->complements[] = new Complement(
            $this->getSourceCode($node),
            $this->getXPath($node),
            'Cet élément n\'a pas d\'attribut id ni d\'attribut title renseigné');
          $reussite = false;
        }
        else
        {
          $id = $node->getAttribute('id');
          $occurences = $crawler->filter('[id='.$id.']');
          if (count($occurences) > 1)
          {
            $this->complements[] = new Complement(
              $this->getSourceCode($node),
              $this->getXPath($node),
              'Cet élément n\'a pas d\'attribut title renseigné et son attribut id n\'est pas unique'
            );
            $reussite = false;
          }
        }
      }
    }
    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}
