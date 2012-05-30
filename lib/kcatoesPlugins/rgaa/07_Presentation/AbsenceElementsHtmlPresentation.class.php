<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceElementsHtmlPresentation extends \ASource
{
  
  const testName = 'Absence d\'éléments HTML utilisés à des fins de présentation';
  const testId = '7.9';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas utilisé uniquement à des fins de présentation, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G115' => 'http://www.w3.org/TR/WCAG20-TECHS/G115'
    ,'F43'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F43'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément :
      
          a         abbr       acronym address area
          bdo       blockquote button
          caption   cite       code
          dd        dfn        dir     dl      dt
          em
          fieldset  form
          h1 à h6
          input     ins
          kbd
          label     legend     li
          menu
          ol
          pre ou suite d'espaces insécables
          q
          samp      select     strong  sub     sup
          th
          var
          ul
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
