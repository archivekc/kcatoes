<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceJustificationTexte extends \ASource
{
  
  const testName = 'Absence de justification du texte';
  const testId = '7.12';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le texte de l\'élément n\'est pas justifié (aligné à gauche et à droite), le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'C19'  => 'http://www.w3.org/TR/WCAG20-TECHS/C19'
    ,'G169' => 'http://www.w3.org/TR/WCAG20-TECHS/G169'
    ,'G172' => 'http://www.w3.org/TR/WCAG20-TECHS/G172'
    ,'F88'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F88'
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
      
      Tout élément constituant visuellement un bloc de texte.
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
