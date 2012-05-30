<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class NavigationClavierOrdreLogique extends \ASource
{
  
  const testName = 'Navigation au clavier dans un ordre logique par rapport au contenu';
  const testId = '6.24';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le parcours au clavier des éléments mentionnés dans le champ d\'application ayant une relation entre eux est logique, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G59'  => 'http://www.w3.org/TR/WCAG20-TECHS/G59'
    ,'H4'  => 'http://www.w3.org/TR/WCAG20-TECHS/H4'
    ,'F44'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F44'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément :
      
          a avec un attribut href
          area
          button
          input
          object
          embed
          select
          textarea
          élément avec attribut tabindex spécifié
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
