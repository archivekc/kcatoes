<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDeLiensOuDeDefinitionsNecessairesALaComprehensionDesContenus extends \ASource
{
  const testName = 'Présence de liens ou de définitions permettant d’avoir accès aux
  informations nécessaires à la compréhension des contenus';
  const testId = '12.4';
  protected static $testProc = array(
    'Si un segment de texte est présent dans la page, poursuivre le test, sinon le test est non applicable',
    'Si le segment de texte est utilisé de manière inhabituelle ou de façon limitée,
    y compris les expressions idiomatiques et le jargon, poursuivre le test, sinon le test non applicable.',
    'Si le segment de texte n’est pas explicité dans le contexte de la page par
    au moins une des solutions suivantes : un élément dfn, une liste de définition,
    la clarification du segment de texte dans le contenu textuel de la page,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G55' => 'http://www.w3.org/TR/WCAG20-TECHS/G55'
  , 'G112' => 'http://www.w3.org/TR/WCAG20-TECHS/G112'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}