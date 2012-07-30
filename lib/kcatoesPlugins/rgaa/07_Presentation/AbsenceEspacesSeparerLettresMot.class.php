<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceEspacesSeparerLettresMot extends \ASource
{

  const testName = 'Absence d\'espaces utilisés pour séparer les lettres d\'un mot';
  const testId = '7.4';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas utilisé afin séparer visuellement les lettres composant un même mot, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'C8'  => 'http://www.w3.org/TR/WCAG20-TECHS/C8'
    ,'F32'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F32'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::MANUEL, 'Vérifier que tout espace
    typographique ou élément vide utilisé pour simuler une espace n\'est pas
    utilisé afin séparer visuellement les lettres composant un même mot');
  }
}
