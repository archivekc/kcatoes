<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAlternativeObjectAppletEmbedPeripherique extends \ASource
{
  
  const testName = 'Présence d\'une alternative aux éléments object, applet et embed dépendant d\'un périphérique';
  const testId = '5.28';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est nécessaire pour avoir accès à l\'information, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si l\'information mise à disposition par l\'élément ne peut pas être obtenue à l\'aide 
      d\'un périphérique de pointage, tel que la souris, et par un au moins une des solutions suivantes :
        raccourci clavier
        navigation au clavier au sein de l\'interface d\'élément en élément
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément a une alternative permettant d\'avoir accès à une information équivalente quelque 
    soit le périphérique utilisé dans ou depuis la page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F15' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F15' 
    ,'F19' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F19'
    ,'F54' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F54'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {

    /*
      Champ d'application
      
      Tout élément :
      
          object
          embed
          applet
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
