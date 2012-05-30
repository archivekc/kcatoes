<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceSousTitrageMediaDirect extends \ASource
{
  
  const testName = 'Présence du sous-titrage synchronisé des médias synchronisés ou sonores diffusés en direct';
  const testId = '5.18';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de télécharger ou de restituer un média synchronisé ou sonore qui 
      apporte de l\'information, poursuivre le test, sinon le test est non applicable.'
    ,'Si ce média synchronisé ou sonore diffuse un contenu en direct, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si le média synchronisé ou sonore nécessite l\'utilisation de sous-titres synchronisés 
      pour le rendre compréhensible, poursuivre le test, sinon le test est non applicable.'
    ,'Si au moins une version du média synchronisé ou sonore mis à disposition utilise des 
      sous-titres synchronisés ou qu\'une transcription textuelle apportant la même information 
      est mise à disposition lors de la diffusion en direct (exemple : un discours en direct 
      pré-écrit), le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G9'   => 'http://www.w3.org/TR/WCAG20-TECHS/G9'
    ,'G151' => 'http://www.w3.org/TR/WCAG20-TECHS/G151'
    ,'G157' => 'http://www.w3.org/TR/WCAG20-TECHS/G157'
    ,'SM11' => 'http://www.w3.org/TR/WCAG20-TECHS/SM11'
    ,'SM12' => 'http://www.w3.org/TR/WCAG20-TECHS/SM12'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément :
      
          a
          applet
          object
          embed
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
