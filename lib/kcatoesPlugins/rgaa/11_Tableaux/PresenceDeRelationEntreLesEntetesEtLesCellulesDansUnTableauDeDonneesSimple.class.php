<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDeRelationEntreLesEntetesEtLesCellulesDansUnTableauDeDonneesSimple extends \ASource
{
  const testName = 'Présence d’une relation entre les en-têtes (th) et les cellules (td)
  qui s’y rattachent dans un tableau de données simple grâce aux attributs id et headers ou scope';
  const testId = '11.2';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si les cellules d’en-tête de lignes (th) ont un attribut scope ayant comme valeur row
    ou si les cellules d’en-tête de colonnes (th) ont un attribut scope ayant comme valeur col
    ou si les cellules d’en-tête (th) ont un attribut id non vide, et que les cellules (td)
    qui s’y rattachent ont un attribut headers contenant la valeur de ces attributs id,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H63' => 'http://www.w3.org/TR/WCAG20-TECHS/H63'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'table';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de tableau de données');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que Si les cellules
         d’en-tête de lignes (th) ont un attribut scope ayant comme valeur row
         ou si les cellules d’en-tête de colonnes (th) ont un attribut scope ayant
         comme valeur col ou si les cellules d’en-tête (th) ont un attribut id
         non vide, et que les cellules (td) qui s’y rattachent ont un attribut
         headers contenant la valeur de ces attributs id');
      }
    }
  }
}