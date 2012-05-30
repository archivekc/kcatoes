<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AccesLiensTextuelsDoublantZonesCliquablesServeur extends \ASource
{
  
  const testName = 'Accès aux liens textuels doublant les zones cliquables côté serveur';
  const testId = '6.1';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut ismap ou est utilisé comme image avec zones cliquables 
      côté serveur, poursuivre le test, sinon le test est non applicable.'
    ,'Si chaque zone cliquable de l\'élément est doublée d\'un lien textuel permettant d\'accéder 
      à la même destination, poursuivre le test, sinon le test est non applicable.'
    ,'Si les liens, regroupés ou non dans la page, sont accessibles directement après l\'élément, 
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F54'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F54'
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
      
      Tout élément :
      
          img
          input type="image"
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
