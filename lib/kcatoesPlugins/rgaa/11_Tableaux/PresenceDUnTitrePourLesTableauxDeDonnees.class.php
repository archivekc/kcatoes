<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDUnTitrePourLesTableauxDeDonnees extends \ASource
{
  const testName = 'Présence d’un titre pour les tableaux de données';
  const testId = '11.7';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si est présent un élément caption, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H39' => 'http://www.w3.org/TR/WCAG20-TECHS/H39'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'table';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de tableau de données');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier qu\'est présent un
        élément caption'');
      }
    }
  }
}