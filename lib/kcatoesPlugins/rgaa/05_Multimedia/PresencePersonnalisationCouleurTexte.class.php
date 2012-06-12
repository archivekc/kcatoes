<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresencePersonnalisationCouleurTexte extends \ASource
{

  const testName = 'Présence d\'un mécanisme pour personnaliser la couleur d\'avant plan et d\'arrière plan des blocs de texte';
  const testId = '5.34';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet d\'afficher des blocs de texte, poursuivre le test, sinon le test
      est non applicable.'
    ,'Si il est mis à disposition un mécanisme permettant de personnaliser la couleur d\'avant
      plan et d\'arrière plan des blocs de texte, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G156' => 'http://www.w3.org/TR/WCAG20-TECHS/G156'
    ,'G175' => 'http://www.w3.org/TR/WCAG20-TECHS/G175'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {

    /*
      Champ d'application

      Tout élément :

          applet
          object
          embed
          tout élément html
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
