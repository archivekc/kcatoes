<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PossibiliteIdentifierDestinationActionLiensBoutonsIntitule extends \ASource
{
  
  const testName = 'Possibilité d\'identifier la destination ou l\'action des liens et des boutons (intitulé seul)';
  const testId = '6.14';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si la lecture de l\'intitulé du lien seul en dehors de son contexte permet à une personne 
      n\'ayant aucun handicap de comprendre l\'action ou d\'identifier la destination du lien, 
      poursuivre le test, sinon le test est non applicable'
    ,'Si la lecture de l\'intitulé du lien seul permet de comprendre l\'action ou d\'identifier 
      la destination du lien, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G91'  => 'http://www.w3.org/TR/WCAG20-TECHS/G91'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
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
