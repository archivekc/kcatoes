<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceDeLaVersionNonAbregeeDeLAbreviation extends \ASource
{
  const testName = 'Pertinence de la version non abrégée de l\'abréviation';
  const testId = '10.11';
  protected static $testProc = array(
    'Si l\'élément est mentionné dans le champ d\'application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si le contenu de l\'attribut title donne accès la version non abrégée de l\'abréviation,
     le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G55' => 'http://www.w3.org/TR/WCAG20-TECHS/G55'
  , 'G70' => 'http://www.w3.org/TR/WCAG20-TECHS/G70'
  , 'G97' => 'http://www.w3.org/TR/WCAG20-TECHS/G97'
  , 'H28' => 'http://www.w3.org/TR/WCAG20-TECHS/H28'
  , 'H60' => 'http://www.w3.org/TR/WCAG20-TECHS/H60'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'abbr';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node) {
      	if(strlen($node->getAttribute('title')) > 0){
          $this->addResult($node, \Resultat::MANUEL, 'La version complète de
            l\'abréviation est-elle pertinente?');
      	}
      }
    }
  }
}