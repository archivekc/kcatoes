<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDInformationsSurLesMotsParLaMiseADispositionDeLeurPrononciationPhonetique extends \ASource
{
  const testName = 'Présence d’informations sur les mots par la mise à disposition de
   leur prononciation phonétique';
  const testId = '12.6';
  protected static $testProc = array(
    'Si un segment de texte est présent dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si la compréhension de certains mots composant le segment de texte peut présenter des difficultés
    lors de la lecture de celui-ci, poursuivre le test, sinon le test est non applicable.',
    'Si la prononciation phonétique des mots posant des difficultés est présente de façon
    adjacente à ces mots ou qu’ils pointent vers leur prononciation phonétique par le biais de lien,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G62' => 'http://www.w3.org/TR/WCAG20-TECHS/G62'
  ,'G120' => 'http://www.w3.org/TR/WCAG20-TECHS/G120'
  ,'G121' => 'http://www.w3.org/TR/WCAG20-TECHS/G121'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::MANUEL, 'Vérifier que les éléments de texte
    difficiles à prononcer aient une pronociation phonétique à proximité, soit
    dans le texte lui-même ou par le biais d\'un lien');
  }
}