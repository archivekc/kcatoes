<?php
namespace Kcatoes\rgaa;

class PresenceDeLIndicationDesChangementsDeLangueDansLesValeursDAttributsHTML extends \ASource
{
  const testName = 'Présence de l’indication des changements de langue dans les valeurs d’attributs HTML';
  const testId = '12.2';
  protected static $testProc = array(
    'Si l’un des attributs mentionnés dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si la contenu de cet attribut constitue un changement de langue par rapport à la langue
    principale de la page ou à celle de l’élément HTML parent de l’élément HTML porteur de l’attribut,
    poursuivre le test, sinon le test est non applicable.',
    'Si le contenu de cette attribut n’est pas un nom propre, un mot/groupe de mots dans une langue indéterminée,
    un mot/groupe de mots pouvant être identifiés s’il est prononcé dans la langue du contexte ou un mot/groupe
    de mots passé dans le langage courant de la langue du contexte, poursuivre le test,
    sinon le test est non applicable.',
    'Si l’élément HTML porteur de l’attribut ou le premier élément HTML ascendant est doté d’un attribut
    lang (ou xml:lang pour du XML ou du XHTML 1.1) correctement renseigné, le test est validé,
    sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H58' => 'http://www.w3.org/TR/WCAG20-TECHS/H58'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
  	$crawler = $this->page->crawler;
    $elements = '[alt], [summary], meta[content], option[label], frame[value],
     iframe[value], [name], [title], object[standby]';
    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::MANUEL, 'Vérifier que l\'absence de
      traitement de langue soit justifiée.');
    }
    else {
      foreach($nodes as $node){
      if(strlen($node->getAttribute('lang'))>0){
          $this->addResult($node, \Resultat::MANUEL, 'La langue est-elle
          correctement renseignée ?');
        }elseif(strlen($node->parentNode->getAttribute('lang'))>0){
          $this->addResult($node->parentNode, \Resultat::MANUEL, 'La langue est-elle
          correctement renseignée ?');
        }else{
        	$this->addResult($node, \Resultat::ECHEC, 'La langue n\'est pas renseignée
        	à proximité de cet élément ');
        }
      }
    }
  }
}