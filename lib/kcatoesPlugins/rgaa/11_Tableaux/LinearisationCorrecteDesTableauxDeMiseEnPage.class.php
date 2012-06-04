<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class LinearisationCorrecteDesTableauxDeMiseEnPage extends \ASource
{
  const testName = 'Linéarisation correcte des tableaux de mise en page';
  const testId = '11.6';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si la lecture linéaire du contenu du tableau (cellule après cellule, dans l’ordre
    du code source) conserve les associations logiques présentes dans son rendu affiché,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur','Contributeur')
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
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que la lecture
        linéaire du contenu du tableau (cellule après cellule, dans l’ordre du
        code source) conserve les associations logiques présentes dans son
        rendu affiché');
      }
    }
  }
}