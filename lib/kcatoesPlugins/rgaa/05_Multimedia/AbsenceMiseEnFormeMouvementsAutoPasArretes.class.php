<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceMiseEnFormeMouvementsAutoPasArretes extends \ASource
{
  
  const testName = 'Absence de mise en forme provoquant des mouvements déclenchés automatiquement ne pouvant pas être arrêtés';
  const testId = '5.26';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si la mise en forme de l\'élément provoque des mouvements qui se déclenchent sans action préalable de 
      l\'utilisateur, poursuivre le test, sinon le test est non applicable.'
    ,'Si le mouvement n\'apporte en lui même aucune information ou qu\'il s\'agit d\'une fonctionnalité qu\'il 
      serait possible de reproduire sans mouvement, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur à le contrôle des mouvements par au moins un des mécanismes suivants :
        possibilité d\'arrêter et de reprendre le mouvement
        la durée du mouvement est inférieure ou égale à 5 secondes
        possibilité de masquer et de réafficher le contenu mouvant
        possibilité d\'afficher la totalité du contenu mouvant sans mouvement
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G4'   => 'http://www.w3.org/TR/WCAG20-TECHS/G4' 
    ,'G186' => 'http://www.w3.org/TR/WCAG20-TECHS/G186'
    ,'F16'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F16'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément mis en forme par des styles utilisant au moins une des propriétés suivantes :
      
          background
          background-image
          content
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
