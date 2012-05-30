<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class CoherenceDestinationActionLiensIntituleIdentique extends \ASource
{
  
  const testName = 'Cohérence de la destination ou de l\'action des liens ayant un intitulé identique';
  const testId = '6.15';
  protected static $testProc = array(
     'Si au moins deux éléments mentionnés dans le champ d\'application sont présents dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si les éléments ont le même intitulé et pointent sur une destination ou entrainent une action 
      différente, poursuivre le test, sinon le test est non applicable.'
    ,'Si les éléments ont un intitulé identique lorsque l\'on leur additionne un contenu récupérable 
      dans au moins un des contextes suivants :
        contenu de leur élément html parent si il s\'agit d\'un élément p ou li
        contenu du titre de hiérarchie (hx) précédent les éléments
        contenu de l\'entête (th) qui leur est rattaché si l\'élément est dans une cellule de tableau (td)
        contenu des éléments de listes parents des éléments dans une liste arborescente (ul,ol,dl)
      qui pointent sur une destination ou entrainent une action différente, poursuivre le test, sinon le test est non applicable.'
    ,'Si les éléments ont un attribut title dont le contenu est différent les uns des autres, 
      qu\'il est plus long que l\'intitulé du lien lui-même et que sa lecture seule permet de comprendre 
      l\'action ou d\'identifier la destination du lien, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G91'  => 'http://www.w3.org/TR/WCAG20-TECHS/G91'
    ,'G197'  => 'http://www.w3.org/TR/WCAG20-TECHS/G197'
    ,'H30'  => 'http://www.w3.org/TR/WCAG20-TECHS/H30'
    ,'H33'  => 'http://www.w3.org/TR/WCAG20-TECHS/H33'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément :
      
          a
          area
          button
          input type="image"
          input type="submit"
          input type="reset"
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
