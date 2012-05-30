<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class CoherencePresentationMenusBarresNavigation extends \ASource
{
  
  const testName = 'Cohérence de la présentation des menus et barres de navigation';
  const testId = '6.23';
  protected static $testProc = array(
     'Si le groupe d\'éléments mentionné dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le groupe d\'éléments est présent sur au moins une autre page du site, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si la page en cours d\'analyse n\'est pas la page d\'accueil, poursuivre le test, sinon le test 
      est non applicable.'
    ,'Si la page en cours d\'analyse est la page d\'accueil, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G61'  => 'http://www.w3.org/TR/WCAG20-TECHS/G61'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Groupe d'éléments a permettant la navigation dans le site ou dans une page.
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
      
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');

  }
}
