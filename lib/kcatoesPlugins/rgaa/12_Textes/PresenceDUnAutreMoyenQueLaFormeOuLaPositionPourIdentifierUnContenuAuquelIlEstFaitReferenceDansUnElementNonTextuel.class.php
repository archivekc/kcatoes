<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDUnAutreMoyenQueLaFormeOuLaPositionPourIdentifierUnContenuAuquelIlEstFaitReferenceDansUnElementNonTextuel extends \ASource
{
  const testName = 'Présence d’un autre moyen que la forme ou la position pour identifier un contenu
  auquel il est fait référence dans un élément non textuel';
  const testId = '12.8';
  protected static $testProc = array(
    'Si l’un des éléments mentionnés dans le champ d’application est présent ou utilisé
    dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si l’élément permet d’afficher un texte de façon graphique ou possède un attribut alt non
    vide, poursuivre le test, sinon le test est non applicable.',
    'Si le texte graphique ou son alternative mentionne une forme ou une position et fait référence
    à un contenu de la page ou du site, poursuivre le test, sinon le test est non applicable.',
    'Si le texte graphique ou son alternative permet d’identifier ce contenu par un autre moyen
    que la forme ou la position, le test est validé sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G96' => 'http://www.w3.org/TR/WCAG20-TECHS/G96'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Développeur', 'Intégrateur','Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'img, input[type=image], applet, object, embed';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que si le texte graphique
        ou son alternative mentionne une forme ou une position et fait référence
        à un contenu de la page ou du site, ce dernier est identifiable par un
        autre moyen que la forme ou la position');
      }
    }
  }
}