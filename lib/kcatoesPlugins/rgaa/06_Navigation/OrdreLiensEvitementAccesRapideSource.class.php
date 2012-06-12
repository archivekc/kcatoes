<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class OrdreLiensEvitementAccesRapideSource extends \ASource
{

  const testName = 'Ordre des liens d\'évitement ou d\'accès rapide dans le code source des pages';
  const testId = '6.33';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent au moins
      deux fois dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'activation de l\'élément permet d\'accéder à un groupe de liens
      importants, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'ordre de l\'élément dans le code source est identique sur toutes
      les pages, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F66'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F66'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    /*
      Champ d'application

      Tout élément a.
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
