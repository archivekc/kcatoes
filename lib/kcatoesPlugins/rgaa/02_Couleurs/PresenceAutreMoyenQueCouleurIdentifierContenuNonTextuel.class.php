<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAutreMoyenQueCouleurIdentifierContenuNonTextuel extends \ASource
{
  
  const testName = 'Présence d\'un autre moyen que la couleur pour identifier un contenu auquel il est fait référence dans un élément non textuel';
  const testId = '2.2';
  protected static $testProc = array(
     'Si l’un des éléments mentionnés dans le champ d’application est présent ou utilisé dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si l’élément permet d’afficher un texte de façon graphique ou possède un attribut alt non vide, poursuivre le test, sinon le test est non applicable.'
    ,'Si le texte graphique ou son alternative mentionne une couleur et fait référence à un contenu de la page ou du site, poursuivre le test, sinon le test est non applicable.'
    ,'Si le texte graphique ou son alternative permet d’identifier ce contenu par un autre moyen que la couleur, le test est validé sinon le test est invalidé.');
  protected static $testDocLinks = array(
    'H92' => 'http://www.w3.org/TR/WCAG20-TECHS/H92'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Couleurs'
    ,'profils'    => array('Rédacteur', 'Contributeur', 'Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
     Champ d’application

      Tout élément :
      
          img
          input de type image
          applet
          object
          embed
          ou code javascript générant un des éléments précédents
    
     */
    $elements = '';

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
