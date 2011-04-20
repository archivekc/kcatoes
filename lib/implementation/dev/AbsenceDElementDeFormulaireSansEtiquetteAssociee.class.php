<?php

/**
 * Vérifie si chaque élément formulaire ayant un attribut id unique mais pas
 * d'attribut title ou un attribut title vide a un label associé.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDElementDeFormulaireSansEtiquetteAssociee extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $crawler = $page->crawler;
    $ids = array();

    $formulaire = $crawler->filter('input[type=text][id], input[type=password][id],
                              input[type=file][id], input[type=radio][id],
                              input[type=checkbox][id], textarea[id], select[id]');

    foreach ($formulaire as $node)
    {
      $id = $node->getAttribute('id');
      if ($id !== '')
      {
        $occurences = $crawler->filter('[id='.$id.']');
        if (count($occurences) === 1)
        {
          if (!$node->hasAttribute('title') || $node->getAttribute('title') == '')
          {
            $labels = $crawler->filter('label[for='.$id.']');
            if (count($labels) === 0)
            {
              $this->complements[] = new Complement(
                $this->getSourceCode($node),
                $this->getXPath($node),
                'Cet élément n\'a pas de label associé à son attribut id ni d\'attribut title renseigné'
              );
              $reussite = false;
            }
          }
        }
      }
    }
    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}