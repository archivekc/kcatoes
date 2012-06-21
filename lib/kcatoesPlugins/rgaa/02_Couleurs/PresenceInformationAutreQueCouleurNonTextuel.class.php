<?php
namespace Kcatoes\rgaa;

class PresenceInformationAutreQueCouleurNonTextuel extends \ASource
{

  const testName = 'Présence d\'un moyen de transmission de l\'information autre qu\'une utilisation de la couleur dans les éléments non textuels';
  const testId = '2.4';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent ou utilisé dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément affiche des zones de couleurs donnant de l\'information, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'information transmise par les zones de couleurs est accessible par un autre moyen que
      la couleur, le test est validé sinon le test est invalidé.');
  protected static $testDocLinks = array(
    'G111' => 'http://www.w3.org/TR/WCAG20-TECHS/G111'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Couleurs'
    ,'profils'    => array('Rédacteur', 'Contributeur', 'Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'img, input[type=image], applet, object, embed';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node){
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l’information
        donnée par la zone de couleur, si il y en a une, est accessible par un
        autre moyen');
      }
    }
  }
}
