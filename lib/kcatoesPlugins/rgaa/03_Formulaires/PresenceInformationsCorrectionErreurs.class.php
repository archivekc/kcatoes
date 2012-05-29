<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceInformationsCorrectionErreurs extends \ASource
{
  
  const testName = 'Présence d\'informations ou de suggestions facilitant la correction des erreurs de saisie';
  const testId = '3.13';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est soumis à un contrôle de saisie avant d\'être traité, poursuivre le test, sinon le test est non applicable.'
    ,'Si des formats ou types de saisie spécifiques sont attendus, poursuivre le test, sinon le test est non applicable.'
    ,'Si le procédé de contrôle de saisie indique les formats ou types de saisie attendus ou propose des suggestions de corrections, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G84'  => 'http://www.w3.org/TR/WCAG20-TECHS/G84'
    ,'G85'  => 'http://www.w3.org/TR/WCAG20-TECHS/G85'
    ,'G177' => 'http://www.w3.org/TR/WCAG20-TECHS/G177'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément form.
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
