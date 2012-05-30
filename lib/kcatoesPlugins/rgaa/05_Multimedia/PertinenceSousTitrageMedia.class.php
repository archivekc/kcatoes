<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceSousTitrageMedia extends \ASource
{
  
  const testName = 'Pertinence du sous-titrage synchronisé des médias synchronisés';
  const testId = '5.10';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si l\'élément apporte suffisamment d\'informations pour comprendre le contenu du média 
      synchronisé (paroles prononcées, bruits, éléments musicaux, intonations, changements 
      d\'orateurs, etc), le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G9'   => 'http://www.w3.org/TR/WCAG20-TECHS/G9'
    ,'SM1'  => 'http://www.w3.org/TR/WCAG20-TECHS/SM1'
    ,'SM12' => 'http://www.w3.org/TR/WCAG20-TECHS/SM12'
    ,'F8'   => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F8'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout contenu textuel constituant les sous-titres synchronisés d'un média synchronisé.
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
