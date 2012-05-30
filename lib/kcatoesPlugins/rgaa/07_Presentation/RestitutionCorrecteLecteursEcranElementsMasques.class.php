<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class RestitutionCorrecteLecteursEcranElementsMasques extends \ASource
{
  
  const testName = 'Restitution correcte dans les lecteurs d\'écran des éléments masqués';
  const testId = '7.18';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le style CSS appliqué sur l\'élément utilise la propriété display:none ou 
      visibility:hidden, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'a pas vocation à être restitué par les lecteurs d\'écran ou que 
      sa restitution devient possible moyennant une interaction de l\'utilisateur avec 
      un élément dans la page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'C7'  => 'http://www.w3.org/TR/WCAG20-TECHS/C7'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément sur lequel sont appliqués dans la page des styles CSS via l’attribut style, 
      une feuille de styles interne, une feuille de styles externe ou du code javascript.
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
