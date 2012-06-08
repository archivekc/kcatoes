<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDUneLangueDeTraitement extends \ASource
{
  const testName = 'Présence d’une langue de traitement';
  const testId = '9.8';
  protected static $testProc = array(
    'Si un segment de texte est présent dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si l’élément HTML contenant le segment de texte ou qu’un de ses éléments HTML ascendants
    possède un attribut lang non vide (ou xml:lang pour du XML ou du XHTML 1.1), contenant le code identifiant
    correctement la langue de traitement de la page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H57' => 'http://www.w3.org/TR/WCAG20-TECHS/H57'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Standards'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = '[lang]';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::MANUEL, 'Vérifier que l\'absence de
      traitement de langue soit justifiée.');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que le traitement
         de langue correspond bien au langage utilisé dans le texte balisé
         concerné');
      }
    }
  }
}