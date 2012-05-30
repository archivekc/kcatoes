<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAvertissementOuvertureFenetreTargetLiens extends \ASource
{
  
  const testName = 'Présence d\'un avertissement préalable à l\'ouverture de nouvelle fenêtre lors de l\'utilisation de l\'attribut target sur les liens textuels et les formulaires';
  const testId = '6.2';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut target, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'attribut target est différent de _top, _parent, _self, poursuivre 
      le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'a pas pour unique enfant un élément img, poursuivre le test sinon le test 
      est non applicable.'
    ,'Si un avertissement signalant l\'ouverture dans une nouvelle fenêtre se trouve dans le 
      contenu de l\'élément seul ou dans le contenu seul additionné à un contenu récupérable dans au moins un des contextes suivants  :
        contenu de son élément html parent si il s\'agit d\'un élément p ou li
        contenu du titre de hiérarchie (hx) précédent l\'élément
        contenu de l\'entête (th) qui lui est rattaché si l\'élément est dans une cellule de tableau (td)
        contenu des éléments de listes parents de l\'élément dans une liste arborescente (ul,ol,dl)
        contenu de l\'attribut title de l\'élément si celui-ci est plus grand que le contenu de l\'élément seul
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H33'  => 'http://www.w3.org/TR/WCAG20-TECHS/H33'
    ,'H83'  => 'http://www.w3.org/TR/WCAG20-TECHS/H83'
    ,'F22'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F22'
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
      
      Tout élément :
      
          a
          form
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
