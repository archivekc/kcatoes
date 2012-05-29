<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceSousTitrageMediaPasDirect extends \ASource
{
  
  const testName = 'Présence du sous-titrage synchronisé des médias synchronisés qui ne sont pas diffusés en direct';
  const testId = '5.9';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de télécharger ou de restituer un média synchronisé qui apporte de 
      l\'information, poursuivre le test, sinon le test est non applicable.'
    ,'Si ce média synchronisé ne diffuse pas un contenu en direct, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si le média synchronisé n\'est pas une alternative animée, sonore ou synchronisée à un 
      contenu textuel présent dans la page, qui est identifiée en tant que tel et qui n\'apporte 
      pas plus d\'information que le contenu textuel, poursuivre le test, sinon le test est non applicable.'
    ,'Si le média synchronisé nécessite l\'utilisation de sous-titres synchronisés pour le rendre 
      compréhensible, poursuivre le test, sinon le test est non applicable.'
    ,'Si au moins une version du média synchronisé mis à disposition utilise des sous-titres 
      synchronisés, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G9'  => 'http://www.w3.org/TR/WCAG20-TECHS/G9' 
    ,'G87' => 'http://www.w3.org/TR/WCAG20-TECHS/G87'
    ,'G93' => 'http://www.w3.org/TR/WCAG20-TECHS/G93'
    ,'F74' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F74'
    ,'F75' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F75'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément :
      
          a
          applet
          object
          embed
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
