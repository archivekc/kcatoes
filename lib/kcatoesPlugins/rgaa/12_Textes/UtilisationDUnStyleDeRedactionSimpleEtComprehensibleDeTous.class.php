<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class UtilisationDUnStyleDeRedactionSimpleEtComprehensibleDeTous
 extends \ASource
{
  const testName = 'Utilisation d’un style de rédaction simple et compréhensible de tous';
  const testId = '12.10';
  protected static $testProc = array(
    'Si un segment de texte est présent dans la page, poursuivre le test,
    sinon le test est non applicable.',
    'Si la compréhension du segment de texte nécessite un niveau d’éducation plus avancé
    que celui obtenu environ neuf ans après le début de la scolarisation (environ niveau 3ème),
    après la suppression des noms propres et des titres, poursuivre le test,
    sinon le test est non applicable.',
    'Si au moins un des types de contenu suivants ou une version additionnelle qui
    ne requiert pas de capacité de lecture supérieure au niveau obtenu neuf ans après
    le début de la scolarisation (environ niveau 3ème) suivante est disponible :
    illustrations visuelles, symboles ou images facilitant la compréhension des contenus,
    version en langue des signes française, version sonore du segment de texte,
    résumé rédigé de manière à ce que sa compréhension ne requiert pas de capacité de
    lecture supérieure au premier cycle de l’enseignement secondaire,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G79' => 'http://www.w3.org/TR/WCAG20-TECHS/G79'
  ,'G86' => 'http://www.w3.org/TR/WCAG20-TECHS/G86'
  ,'G103' => 'http://www.w3.org/TR/WCAG20-TECHS/G103'
  ,'G153' => 'http://www.w3.org/TR/WCAG20-TECHS/G153'
  ,'G160' => 'http://www.w3.org/TR/WCAG20-TECHS/G160'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}