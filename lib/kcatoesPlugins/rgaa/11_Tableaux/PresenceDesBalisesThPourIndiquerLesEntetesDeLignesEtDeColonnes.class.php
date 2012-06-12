<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDesBalisesThPourIndiquerLesEntetesDeLignesEtDeColonnes extends \ASource
{
  const testName = 'Présence des balises th pour indiquer les en-têtes de lignes
   et de colonnes dans les tableaux de données';
  const testId = '11.1';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si l’élément a un ou plusieurs segments de texte pouvant être identifié comme
    en-tête de colonne ou de ligne, poursuivre le test, sinon le test est non applicable .',
    'Si chaque segment de texte est contenu dans un élément th, le test est validé,
     sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H51' => 'http://www.w3.org/TR/WCAG20-TECHS/H51'
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

        $this->addResult($node, \Resultat::MANUEL, 'Vérifier si les segments de
        textes sont contenus dans un élément th');
      }
    }
  }
}