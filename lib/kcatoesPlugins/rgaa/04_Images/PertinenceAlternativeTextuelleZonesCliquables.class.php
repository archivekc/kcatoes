<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceAlternativeTextuelleZonesCliquables extends \ASource
{
  
  const testName = 'Pertinence de l\'alternative textuelle aux zones cliquables ou aux boutons graphiques';
  const testId = '4.3';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas utilisé comme captcha ou ne fait pas partie d\'un test qui 
      deviendrait inutile si l\'alternative textuelle était présente, poursuivre le test, 
      sinon le test est non applicable, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut alt, poursuivre le test, sinon le test non applicable.'
    ,'Si le contenu de l\'attribut alt permet de comprendre l\'action ou d\'identifier la 
      destination du lien, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H24' => 'http://www.w3.org/TR/WCAG20-TECHS/H24'
    ,'H36' => 'http://www.w3.org/TR/WCAG20-TECHS/H36'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {

    /*
      Champ d'application
      
      Tout élément :
      
          area
          input type="image"
          tout code javascript générant un des éléments précédents
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
