<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceRegroupementLiensImportants extends \ASource
{
  
  const testName = 'Présence de regroupement pour les liens importants';
  const testId = '6.29';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent au moins deux fois dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le lien fait partie d\'un groupe important (zone de navigation, zone de contenu global, 
      zone d\'outils, etc), poursuivre le test, sinon le test est non applicable.'
    ,'Si le lien est contenu dans un élément HTML parent, commun aux autres liens du même groupe, 
      sans que ne soit présent de liens d\'un groupe différent, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H50'  => 'http://www.w3.org/TR/WCAG20-TECHS/'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
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
      
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');

  }
}
