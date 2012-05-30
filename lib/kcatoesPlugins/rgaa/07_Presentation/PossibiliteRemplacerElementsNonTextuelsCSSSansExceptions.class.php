<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PossibiliteRemplacerElementsNonTextuelsCSSSansExceptions extends \ASource
{
  
  const testName = 'Possibilité de remplacer les éléments non textuels par une mise en forme effectuée grâce aux styles CSS (sans exceptions)';
  const testId = '7.7';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément contient du texte, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas un logotype ou purement décoratif, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si l\'élément utilise une mise en forme ou un effet visuel ne pouvant pas être 
      reproduit de façon similaire par des styles CSS, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'C22'  => 'http://www.w3.org/TR/WCAG20-TECHS/C22'
    ,'C30'  => 'http://www.w3.org/TR/WCAG20-TECHS/C30'
    ,'G140' => 'http://www.w3.org/TR/WCAG20-TECHS/G140'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément :
      
          img
          object
          embed
          applet
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
