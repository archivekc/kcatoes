<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceLiensEvitementAccesRapideGroupesLiensImportants extends \ASource
{
  
  const testName = 'Présence de liens d\'évitement ou d\'accès rapide aux groupes de liens importants';
  const testId = '6.31';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si un élément a non vide permet d\'accéder à l\'ancre, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G1'   => 'http://www.w3.org/TR/WCAG20-TECHS/G1'
    ,'G123' => 'http://www.w3.org/TR/WCAG20-TECHS/G123'
    ,'G124' => 'http://www.w3.org/TR/WCAG20-TECHS/G124'
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
      
      Tout élément HTML contenant un groupe de liens importants (zone de navigation, zone de contenu global ou partie de contenu, zone d'outils, etc) et identifié par une ancre.
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
