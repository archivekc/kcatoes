<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class NiveauSonorePisteDialogue extends \ASource
{
  
  const testName = 'Niveau sonore de la piste de dialogue';
  const testId = '5.33';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de jouer ou de télécharger un élément contenant au moins une piste 
      de dialogue apportant de l\'information et au moins une piste de fond sonore, poursuivre 
      le test, sinon le test est non applicable.'
    ,'Si la ou les pistes de dialogue sont 20 décibels plus élevées que le fond sonore ou que 
      la piste de fond sonore peut être désactivée, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G56' => 'http://www.w3.org/TR/WCAG20-TECHS/G56' 
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément :
      
          a
          area
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
