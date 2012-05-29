<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceVersionLangueSignesFr extends \ASource
{
  
  const testName = 'Pertinence de la version en langue des signes française';
  const testId = '5.32';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de télécharger ou de mettre à disposition une version complémentaire 
      en langue des signes d\'un contenu, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu rendu dans la version complémentaire en langue des signes permet d\'avoir 
      accès à des informations équivalentes à celles disponibles dans le contenu principal, le 
      test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G54'  => 'http://www.w3.org/TR/WCAG20-TECHS/G54' 
    ,'G81'  => 'http://www.w3.org/TR/WCAG20-TECHS/G81'
    ,'G160' => 'http://www.w3.org/TR/WCAG20-TECHS/G160'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément :
      
          a
          area
          applet
          embed
          object
     */
    $elements   = '';

    $nodes = $crawler->filter($elements);

    /*
      $this->addResult($node, \Resultat::ECHEC, '');
      $this->addResult($node, \Resultat::REUSSITE, '');
      $this->addResult(null,  \Resultat::NA, '');
      $this->addResult($node, \Resultat::MANUEL, '');
      $this->addResult(null, \Resultat::MANUEL, '');
      
      foreach ($nodes as $node)
      {
      }

      if (count($nodes) == 0)
      {
      }
     */
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');

  }
}
