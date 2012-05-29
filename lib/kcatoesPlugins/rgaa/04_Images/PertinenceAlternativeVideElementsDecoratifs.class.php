<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceAlternativeVideElementsDecoratifs extends \ASource
{
  
  const testName = 'Pertinence de l\'alternative vide aux éléments décoratifs';
  const testId = '4.5';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est uniquement décoratif, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas contenu dans un élément a ou button, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut alt vide, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H67' => 'http://www.w3.org/TR/WCAG20-TECHS/H67'
    ,'F38' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F38'
    ,'F39' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F39'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément :
      
          img
          applet
          tout code javascript générant un des éléments précédents
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
