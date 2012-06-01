<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceDuResumeDuTableauDeDonnees extends \ASource
{
  const testName = 'Pertinence du résumé du tableau de données';
  const testId = '11.10';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si l’élément possède un attribut summary non vide, poursuivre le test, sinon le test est non applicable.',
    'Si le contenu de l’attribut summary explicite l’organisation des données dans le tableau,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H73' => 'http://www.w3.org/TR/WCAG20-TECHS/H73'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}