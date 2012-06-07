<?php
namespace Kcatoes\rgaa;

class PresenceFilAriane extends \ASource
{

  const testName = 'Présence d\'un fil d\'ariane';
  const testId = '6.20';
  protected static $testProc = array(
     'Si l\'élément présent dans le champ d\'application est présent dans la page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G65'  => 'http://www.w3.org/TR/WCAG20-TECHS/G65'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::MANUEL, 'Valider la présence d\'un fil
     d\'Ariane');
  }
}
