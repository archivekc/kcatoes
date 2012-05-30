<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PossibiliteIdentifierDestinationActionLiensBoutons extends \ASource
{
  
  const testName = 'Possibilité d\'identifier la destination ou l\'action des liens et des boutons';
  const testId = '6.13';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si la lecture de l\'intitulé du lien seul en dehors de son contexte permet à une personne 
      n\'ayant aucun handicap de comprendre l\'action ou d\'identifier la destination du lien, poursuivre le test, sinon le test est non applicable'
    ,'Si la lecture de l\'intitulé du lien seul permet de comprendre l\'action ou d\'identifier la 
      destination du lien ou que de l\'intitulé seul additionné aux contenus récupérables dans au moins un des contextes suivants :
        contenu de son élément html parent si il s\'agit d\'un élément p ou li
        contenu du titre de hiérarchie (hx) précédent l\'élément
        contenu de l\'entête (th) qui lui est rattaché si l\'élément est dans une cellule de tableau (td)
        contenu des éléments de listes parents de l\'élément dans une liste arborescente (ul,ol,dl)
        contenu de l\'attribut title de l\'élément si celui si est plus long que l\'intitulé du lien lui même
      permet de comprendre l\'action ou d\'identifier la destination du lien, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G91' => 'http://www.w3.org/TR/WCAG20-TECHS/G91'
    ,'H30' => 'http://www.w3.org/TR/WCAG20-TECHS/H30'
    ,'H33' => 'http://www.w3.org/TR/WCAG20-TECHS/H33'
    ,'F63' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F63'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément :
      
          a
          area
          button
          input type="image"
          input type="submit"
          input type="button"
          input type="reset"
     */
    
    /*
      $crawler = $this->page->crawler;
      $elements = '';
      $nodes = $crawler->filter($elements);

      $this->addResult($node, \Resultat::ECHEC, '');
      $this->addResult($node, \Resultat::REUSSITE, '');
      $this->addResult(null,  \Resultat::NA, '');
      $this->addResult($node, \Resultat::MANUEL, '');
      
     */
      
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');

  }
}
