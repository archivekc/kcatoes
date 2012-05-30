<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceMiseEnFormeClignotementsAutoPasArretes extends \ASource
{
  
  const testName = 'Absence de mise en forme provoquant des clignotements déclenchés automatiquement ne pouvant pas être arrêtés';
  const testId = '5.22';
  protected static $testProc = array(
     'Si la mise en forme de l\'élément provoque des clignotements qui se déclenche sans action préalable de l\'utilisateur, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le clignotements n\'apporte en lui même aucune information ou qu\'il s\'agit d\'une fonctionnalité qu\'il serait 
      possible à reproduire sans clignotement, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur à le contrôle des clignotements par au moins un des mécanismes suivants :
        possibilité d\'arrêter et de reprendre le clignotement
        la durée du clignotement est inférieure ou égale à 5 secondes
        possibilité de masquer et de réafficher le contenu clignotant
        possibilité d\'afficher la totalité du contenu clignotant sans clignotements
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G11'  => 'http://www.w3.org/TR/WCAG20-TECHS/G11' 
    ,'G186' => 'http://www.w3.org/TR/WCAG20-TECHS/G186'
    ,'G187' => 'http://www.w3.org/TR/WCAG20-TECHS/G187'
    ,'F4'   => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F4'
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
      
      Tout élément mis en forme par des styles utilisant au moins une des propriétés suivantes :
      
          background
          background-image
          content
          text-decoration avec la valeur blink
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
