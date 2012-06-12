<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceJavascriptChangementsLuminositeFlash extends \ASource
{

  const testName = 'Absence de code javascript provoquant des changements brusques de luminosité ou des effets de flash rouge à fréquence élevée';
  const testId = '5.14';
  protected static $testProc = array(
     'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le code javascript provoque des changements brusques de luminosité ou des effets de flash rouge,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si les changements brusques de luminosité ou les effets de flash rouge se font à une fréquence inférieure
      ou égale à 3 par seconde ou que la surface totale d\'affichage cumulée des changements brusques de luminosité
      ou des effets de flash rouge dans une zone de 341 x 256 pixels est inférieure à 25% de celle-ci (21 284 pixels),
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G15' => 'http://www.w3.org/TR/WCAG20-TECHS/G15'
    ,'G19' => 'http://www.w3.org/TR/WCAG20-TECHS/G19'
    ,'F17' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F17'
    ,'F68' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F68'
    ,'F82' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F82'
    ,'F86' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F86'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    /*
      Champ d'application

      Tout code javascript utilisé dans la page.
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
