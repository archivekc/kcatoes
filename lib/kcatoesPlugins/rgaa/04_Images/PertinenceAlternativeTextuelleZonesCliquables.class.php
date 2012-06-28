<?php
namespace Kcatoes\rgaa;

// TODO : images générées par JavaScript
// TODO : cas des Captcha (validation manuelle ?)

class PertinenceAlternativeTextuelleZonesCliquables extends \ASource
{

  const testName = 'Pertinence de l\'alternative textuelle aux zones cliquables ou aux boutons graphiques';
  const testId = '4.3';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas utilisé comme captcha ou ne fait pas partie d\'un test qui
      deviendrait inutile si l\'alternative textuelle était présente, poursuivre le test,
      sinon le test est non applicable, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut alt, poursuivre le test, sinon le test non applicable.'
    ,'Si le contenu de l\'attribut alt permet de comprendre l\'action ou d\'identifier la
      destination du lien, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H24' => 'http://www.w3.org/TR/WCAG20-TECHS/H24'
    ,'H36' => 'http://www.w3.org/TR/WCAG20-TECHS/H36'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'area, input[type=image]';

    $nodes = $crawler->filter($elements);
    foreach ($nodes as $node)
    {
      $alt = trim($node->getAttribute('alt'));
      if (strlen($alt) > 0) {
        $this->addResult($node, \Resultat::MANUEL, 'L\'attribut alt ('.$alt.')
        permet-t-il d’identifier la destination du lien ou l’action déclenchée?');
      }
      else {
        $this->addResult($node, \Resultat::NA, 'Pas d\'attribut alt');
      }
    }
  }
}
