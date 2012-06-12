<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

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
    /*
      Champ d'application

      Tout élément :

          img
          input de type image
          applet
          object
          embed

      ou code javascript générant un des éléments précédents.
     */


    /*
      $crawler = $this->page->crawler;
      $elements = '';
      $nodes = $crawler->filter($elements);

      $this->addResult($node, \Resultat::ECHEC, '');
      $this->addResult($node, \Resultat::REUSSITE, '');
      $this->addResult(null,  \Resultat::NA, '');
      $this->addResult($node, \Resultat::MANUEL, '');

     */

     $this->addResult(null, \Resultat::MANUEL, 'Pas implémenté');

  }
}
