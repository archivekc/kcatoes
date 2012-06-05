<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class UtilisationSystematiqueDeListesOrdonneesPourLesEnumerations extends \ASource
{
  const testName = 'Utilisation systématique de listes ordonnées pour les énumérations';
  const testId = '10.6';
  protected static $testProc = array(
    'Si deux segments de texte différents ou identiques sont présents dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si les segments de texte nécessitent un classement ordonné, poursuivre le test,
     sinon le test est non applicable.',
    'Si les segments de texte sont regroupés dans un élément ol et qu’ils sont placés
     dans des éléments li, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H48' => 'http://www.w3.org/TR/WCAG20-TECHS/H48'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'li, ol';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'La balise ol et li sont-elles
        correctement organisées?');
      }
    }
  }
}