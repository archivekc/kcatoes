<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class CoherenceLiensEvitementAccesRapideGroupesLiensImportants extends \ASource
{

  const testName = 'Cohérence des liens d\'évitement ou d\'accès rapide aux groupes de liens importants';
  const testId = '6.32';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'activation de l\'élément permet de passer ou d\'accéder à un groupe de
      liens importants, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'activation de l\'élément amène à l\'endroit annoncé par l\'intitulé du lien
      et que la navigation au clavier peut être poursuivie à partir de là, le test est
      validé sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G53'  => 'http://www.w3.org/TR/WCAG20-TECHS/G53'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
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
