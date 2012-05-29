<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class IndependancePeripheriqueAccesObjectEmbedApplet extends \ASource
{
  
  const testName = 'Indépendance du périphérique d\'accès aux éléments object, embed, et applet';
  const testId = '5.27';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'interface de l\'élément ne peut pas être utilisée par un périphérique de pointage 
      tel que la souris et par au moins une de ces deux techniques :
        raccourci clavier
        navigation au clavier au sein de l\'interface d\'élément en élément
      poursuivre le test, sinon le test est non applicable.'
    ,'Si une alternative accessible à l\'ensemble des informations présentes dans l\'élément 
      est disponible dans la page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G90' => 'http://www.w3.org/TR/WCAG20-TECHS/G90' 
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément :
      
          object
          embed
          applet
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
