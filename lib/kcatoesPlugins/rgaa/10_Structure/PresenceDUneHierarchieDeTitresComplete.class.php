<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDUneHierarchieDeTitresComplete extends \ASource
{
  const testName = 'Présence d\'une hiérarchie de titres complète';
  const testId = '10.4';
  protected static $testProc = array(
    'Si le contenu mentionné dans le champ d\'application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si le contenu nécessite une structuration hiérarchique au-delà du seul h1,
    poursuivre le test, sinon le test est non applicable.',
    'Si le contenu est structuré par le ou les titres de hiérarchie (h1 à h6) nécessaire
     à la bonne structuration du contenu, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G141' => 'http://www.w3.org/TR/WCAG20-TECHS/G141'
  ,'H69' => 'http://www.w3.org/TR/WCAG20-TECHS/H69'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
  	$crawler = $this->page->crawler;

    $elements   = 'h1, h2, h3, h4, h5, h6';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Le contenu est-il bien structuré?');
      }
    }
  }
}