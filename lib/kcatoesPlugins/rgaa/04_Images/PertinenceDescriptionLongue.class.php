<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceDescriptionLongue extends \ASource
{
  
  const testName = 'Pertinence de la description longue pour les images le nécessitant';
  const testId = '4.8';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément nécessite d\'avoir une description longue, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'ensemble des informations véhiculées par l\'élément est rendu accessible par une description longue, le test est validé, sinon le test invalidé.'
  );
  protected static $testDocLinks = array(
     'G73' => 'http://www.w3.org/TR/WCAG20-TECHS/G73'
    ,'G74' => 'http://www.w3.org/TR/WCAG20-TECHS/G74'
    ,'G92' => 'http://www.w3.org/TR/WCAG20-TECHS/G92'
    ,'F67' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F67'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Rédacteur', 'Contributeur')
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
