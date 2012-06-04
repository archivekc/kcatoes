<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDesElementsPropresAuxTableauxDeDonneesDansLesTableauxDeMiseEnPage extends \ASource
{
  const testName = 'Présence d’une relation entre les en-têtes (th) et les cellules (td)
  qui s’y rattachent dans un tableau de données complexe grâce aux attributs id et headers';
  const testId = '11.4';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si l’élément ne possède pas d’attribut summary ou possède un attribut summary vide (summary=""),
    et qu’il ne contient aucun des éléments ou attributs suivants: th, caption, thead,
    tfoot, colgroup, scope, headers, axis, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'table';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de tableau de mise en page');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l’élément ne
        possède pas d’attribut summary ou possède un attribut summary vide
        (summary=""), et qu’il ne contient aucun des éléments ou attributs suivants :
        th, caption, thead, tfoot, colgroup, scope, headers, axis');
      }
    }
  }
}