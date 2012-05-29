<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PossibiliteControlerActivationDescriptionAudio extends \ASource
{
  
  const testName = 'Possibilité de contrôler l\'activation de la description audio synchronisée';
  const testId = '5.6';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent ou utilisé dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet d\'afficher ou de télécharger un contenu multimédia, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si au moins une version de l\'élément mise à disposition utilise une description audio synchronisée, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si la description audio synchronisée peut être activée ou désactivée selon le choix de l\'utilisateur 
      et quel que soit le périphérique utilisé, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G78' => 'http://www.w3.org/TR/WCAG20-TECHS/G78' 
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
      
          a
          area
          applet
          object
          embed
          tout code javascript générant un des éléments précédents ou déclenchant un téléchargement
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
