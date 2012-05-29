<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class CompatibiliteElementsProgrammablesAidesTechniques extends \ASource
{
  
  const testName = 'Compatibilité des éléments programmables avec les aides techniques';
  const testId = '5.16';
  protected static $testProc = array(
     'Si l\'un des élément mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas accessible aux aides techniques par l\'intermédiaire d\'une API 
      d\'accessibilité ou des fonctionnalités d\'accessibilité, poursuivre le test, sinon le 
      test est non applicable.'
    ,'Si les fonctionnalités contenues dans l\'élément sont disponibles sous forme d\'une 
      alternative accessible, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G10'  => 'http://www.w3.org/TR/WCAG20-TECHS/G10'
    ,'G135' => 'http://www.w3.org/TR/WCAG20-TECHS/G135'
    ,'F79'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F79'
    ,'F15'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F15'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément :
      
          objet
          applet
          embed
     */
    $elements   = '';

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
