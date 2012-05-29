<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceTotaleChangementsLuminositeFlash extends \ASource
{
  
  const testName = 'Absence totale de changements brusques de luminosité ou des effets flash rouge à fréquence élevée';
  const testId = '5.17';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément provoque des changements brusques de luminosité ou des effets de flash rouge, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si les changements brusques de luminosité ou les effets de flash rouge se font à une fréquence 
      inférieure ou égale à 3 par seconde, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G19' => 'http://www.w3.org/TR/WCAG20-TECHS/G19'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Graphiste', 'Ergonome', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout code javascript utilisé dans la page, tout élément mis en forme par des styles utilisant au moins une des propriétés suivantes :
      
          background
          background-image
          content
      
      Tout élément :
      
          applet
          object
          embed
          img au format gif , apng ou mng
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
