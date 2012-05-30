<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceInformationsPoidsTelechargement extends \ASource
{
  
  const testName = 'Présence des informations de poids pour les documents en téléchargement';
  const testId = '6.27';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément provoque le téléchargement d\'un document, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si le poids du document est indiqué dans le libellé de l\'élément déclenchant le téléchargement 
      ou le libellé seul additionné à un contenu récupérable par au moins un des contextes suivants :'
    ,array(
       'contenu de son élément html parent si il s\'agit d\'un élément p ou li'
      ,'contenu du titre de hiérarchie (hx) précédent l\'élément'
      ,'contenu de l\'entête (th) qui lui est rattaché si l\'élément est dans une cellule de tableau (td)'
      ,'contenu des éléments de listes parents de l\'élément dans une liste arborescente (ul,ol,dl)'
      ,'contenu de l\'attribut title de l\'élément'
    )
    ,'le test est validé, sinon il est invalidé.'
  );
  protected static $testDocLinks = array(
     'H33'  => 'http://www.w3.org/TR/WCAG20-TECHS/H33'
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
      
          a
          area
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
