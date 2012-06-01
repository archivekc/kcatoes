<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class MiseAJourDesAlternativesAuxElementsNonTextuels extends \ASource
{
	const testName = 'Mise à jour des alternatives aux éléments non textuels';
	const testId = '8.1';
  protected static $testProc = array(
    'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript déclenche la mise à jour d’un élément non textuel dans au moins une des situations suivantes :
    dans le contenu de la page, dans un iframe, dans un frame, poursuivre le test,
    sinon le test est non applicable.',
    'Si après chaque mise à jour, l’alternative de l’élément non textuel ayant subit la mise à jour
     a également été mise à jour, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}