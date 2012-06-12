<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAutreMoyenQueCouleurIdentifierContenuTextuellement extends \ASource
{

  const testName = 'Présence d\'un autre moyen que la couleur pour identifier un contenu auquel il est fait référence textuellement';
  const testId = '2.1';
  protected static $testProc = array(
     'Si le segment de texte mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le segment de texte fait référence à un contenu de la page ou du site, poursuivre le test, sinon le test est non applicable.'
    ,'Si le segment de texte permet d\'identifier ce contenu par un autre moyen que la couleur, le test est validé, sinon le test est invalidé.');
  protected static $testDocLinks = array(
    'G182' => 'http://www.w3.org/TR/WCAG20-TECHS/G182'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Couleurs'
    ,'profils'    => array('Rédacteur', 'Contributeur', 'Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {

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
