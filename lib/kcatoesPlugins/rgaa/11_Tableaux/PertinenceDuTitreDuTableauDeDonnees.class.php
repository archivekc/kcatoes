<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceDuTitreDuTableauDeDonnees extends \ASource
{
  const testName = 'Pertinence du titre du tableau de données';
  const testId = '11.9';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si est présent un élément caption non vide ou un contenu faisant office de titre
    situé immédiatement avant le tableau de donnée dans l’ordre du code source,
    poursuivre le test, sinon le test est non applicable.',
    'Si la lecture du contenu de l’élément caption ou du contenu faisant office de titre
    permet de déduire la fonction ou le contenu du tableau de données, le test est validé,
     sinon le test est invalidé.'
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
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l’élément est pertinent');
      }
    }
  }
}