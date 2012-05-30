<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceVersionLangueSignesFrMedia extends \ASource
{
  
  const testName = 'Présence de version en langue des signes française facilitant la compréhension des médias synchronisés';
  const testId = '5.31';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de télécharger ou de mettre à disposition une version en langue 
      des signes française d\'un média synchronisé, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G54'  => 'http://www.w3.org/TR/WCAG20-TECHS/G54' 
    ,'G79'  => 'http://www.w3.org/TR/WCAG20-TECHS/G79'
    ,'G103' => 'http://www.w3.org/TR/WCAG20-TECHS/G103'
    ,'G121' => 'http://www.w3.org/TR/WCAG20-TECHS/G121'
    ,'SM13' => 'http://www.w3.org/TR/WCAG20-TECHS/SM13'
    ,'SM14' => 'http://www.w3.org/TR/WCAG20-TECHS/SM14'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément :
      
          a
          area
          applet
          embed
          object
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
