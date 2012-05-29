<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAttributLongdescRelationImageDescription extends \ASource
{
  
  const testName = 'Présence de l\'attribut longdesc pour établir une relation entre une image et sa description longue';
  const testId = '4.9';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément nécessite l\'utilisation d\'une description longue pour être compris, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu immédiatement adjacent à l\'élément ne contient pas un lien permettant 
      d\'avoir accès à la description longue de l\'élément, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si l\'élément possède au moins un des mécanismes suivants :
        attribut longdesc
        attribut alt
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'attribut longdesc ou de l\'attribut alt permet de localiser 
      la description longue, le test est validé, sinon le test invalidé.'
  );
  protected static $testDocLinks = array(
     'G73' => 'http://www.w3.org/TR/WCAG20-TECHS/G73'
    ,'H45' => 'http://www.w3.org/TR/WCAG20-TECHS/H45'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément img ou tout code javascript générant un élément img.
     */
    $elements = '';

    $nodes = $crawler->filter($elements);
    
    /*
      $this->addResult($node, \Resultat::ECHEC, '');
      $this->addResult($node, \Resultat::REUSSITE, '');
      $this->addResult(null,  \Resultat::NA, '');
      $this->addResult($node, \Resultat::MANUEL, '');
      $this->addResult(null, \Resultat::MANUEL, '');
      
      foreach ($nodes as $node)
      {
      }

      if (count($nodes) == 0)
      {
      }
     */
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');
          
  }
}
