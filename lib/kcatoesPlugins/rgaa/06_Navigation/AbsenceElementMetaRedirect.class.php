<?php
namespace Kcatoes\rgaa;



class AbsenceElementMetaRedirect extends \ASource
{
  
  const testName = 'Absence d\'élément meta provoquant une redirection automatique de la page';
  const testId = '6.10';
  protected static $testProc = array(
    'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.', 
    'Si l\'attribut content est présent sur l\'élément, poursuivre le test, sinon le test est non applicable.', 
    'Si l\'attribut content a comme valeur un entier supérieur ou égal à 0 et inférieure à 72000, poursuivre le test, sinon le test est non applicable.', 
    'Si la limite de temps avant le rafraichissement ne pourrait être supprimée sans changer fondamentalement l\'information ou les fonctionnalités du contenu, poursuivre le test, sinon le test est non applicable.', 
    'Si l\'attribut content a une deuxième valeur url contenant une URL égale à celle de la ressource courante ou que la limite de temps préalable à la redirection ne pourrait être supprimée sans changer fondamentalement l\'information ou les fonctionnalités du contenu, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
    'H76'  => 'http://www.w3.org/TR/WCAG20-TECHS/H76.html',
    'SVR1' => 'http://www.w3.org/TR/WCAG20-TECHS/SVR1.html',
    'F40'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F40.html',
    'F41'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F41.html'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'meta';

    $nodes = $crawler->filter($elements);
        
    $nbNode = 0;
    foreach ($nodes as $node)
    {
      $httpequiv = $node->getAttribute('http-equiv');
      
      //Teste si la balise correspond
      if (strcasecmp($httpequiv, 'refresh') == 0){
        $nbNode++;       
        $content = trim($node->getAttribute('content'));
        if (strlen($content) > 0) {
          
          // Identifie le délai de rafraichissement et l'url
          $pattern = '/^([0-9]*)(;?\s?(url=(.*))?)?$/i';
          $matches = array();
          $res = preg_match($pattern, $content, $matches);      
          $delay = isset($matches[1]) ? $matches[1] : '';
          $url   = isset($matches[4]) ? $matches[4] : '';

          if (is_numeric($delay) && ( (0 <= intval($delay)) && ( intval($delay) < 72000) ) ) {
            $this->addResult($node, \Resultat::MANUEL, 'Le rafraîchissement est-il réellement nécessaire à l\'information ou la fonctionnalité du contenu ?');
            
            if ($url == $this->page->__get('url')) {
              $this->addResult(null, \Resultat::REUSSITE, 'L\'élément meta provoque un rafraichissement de la page');
            }
          }
          else {
            $this->addResult(null, \Resultat::NA, 'Le délai de rafraichissement est inférieur à 0 ou supérieur ou égal à 72000 : ' . $delay);
          }
        }
        else {
          $this->addResult(null, \Resultat::NA, 'L\'élément meta n\'a pas d\'attribut content non vide');
        }
      }
    }
    
    if ($nbNode == 0){
      $this->addResult(null, \Resultat::REUSSITE, 'Il n\'y a pas d\'élément meta provoquant un rafraîchissement automatique de la page.');
    }

  }
  
}
