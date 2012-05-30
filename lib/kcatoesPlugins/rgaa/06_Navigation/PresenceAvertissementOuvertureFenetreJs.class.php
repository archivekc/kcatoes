<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAvertissementOuvertureFenetreJs extends \ASource
{
  
  const testName = 'Présence d\'un avertissement préalable à l\'ouverture de nouvelle fenêtre lors de l\'utilisation de code javascript';
  const testId = '6.4';
  protected static $testProc = array(
     'Si du code javascript est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le code javascript déclenche l\'ouverture dans une nouvelle fenêtre, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'élément sur lequel est appliqué le code javascript ne signale pas l\'ouverture 
      dans une nouvelle fenêtre, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'élément faisant office d\'intitulé, récupéré dans un des contextes suivants :
        contenu textuel de l\'élément + contenu de son élément html parent si il s\'agit d\'un élément p ou li
        contenu textuel de l\'élément + contenu du titre de hiérarchie (hx) précédent l\'élément
        contenu textuel de l\'élément + contenu de l\'entête (th) qui lui est rattaché si l\'élément est dans une cellule de tableau (td)
        contenu textuel de l\'élément + contenu des éléments de listes parents de l\'élément dans une liste arborescente (ul,ol,dl)
        contenu de l\'attribut title sur l\'élément
        contenu de l\'attribut alt pour images liens ou les zones cliquables
      signale l\'ouverture dans une nouvelle fenêtre, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H33'   => 'http://www.w3.org/TR/WCAG20-TECHS/H33'
    ,'SCR24' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR24'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout code javascript utilisé dans la page.
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
