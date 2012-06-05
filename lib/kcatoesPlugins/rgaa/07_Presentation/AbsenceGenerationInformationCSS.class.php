<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceGenerationInformationCSS extends \ASource
{

  const testName = 'Absence de génération de contenus porteurs d\'information via les styles CSS';
  const testId = '7.1';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le style CSS appliqué sur l\'élément utilise la propriété content, poursuivre le test, sinon le test est non applicable.'
    ,'Si cette propriété CSS génère un contenu qui n\'est pas porteur d\'information, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F3'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F3'
    ,'F87' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F87'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult($node, \Resultat::MANUEL, 'Vérifier que la propriété CSS
    content génère un contenu qui n’est pas porteur d’information');
  }
}
