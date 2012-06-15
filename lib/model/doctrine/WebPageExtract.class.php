<?php

/**
 * WebPageExtract
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    kcatoes
 * @subpackage model
 * @author     Key Consulting
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class WebPageExtract extends BaseWebPageExtract
{

    public function getResultsInfo(){
    $resultsInfo = Doctrine_Query::create()
      ->select('tr.class, tr.result, trl.result, trl.comment, trl.xpath, trl.css_selector, trl.source, trl.prettySource')
      ->from('TestResult tr')
      ->innerJoin('tr.CollectionLines trl')
      //->leftJoin('sp.WebPage wp, wp.CollectionExtracts e, e.CollectionResults t')
      ->where('tr.web_page_extract_id = ?', $this->getId())
      //->orderBy('tr.id ASC')
      ->execute();
    
      //die(var_dump($resultsInfo));
    return $resultsInfo;
  }

  /**
   * Retourne les résultats des tests sur l'extraction courante 
   * @param $tests       Liste des classes de test à prendre en compte
   * @return Doctrine_Collection
   */
  public function getResults($tests=array())
  {
    $query = Doctrine_Core::getTable('TestResult')->createQuery('r')
                ->where('r.web_page_extract_id = ?', $this->getId())
                ->orderBy('r.num_categorie, r.num_test');
    
    $results = $query->execute();
    return $results;
  }

  /**
   * Retourne l'extraction associée à tous ses résultats sous forme de collection 
   * @return Doctrine_Collection
   */
  public function getResultsForUpdate()
  {
    $query = Doctrine_Core::getTable('TestResult')->createQuery('r')
                ->leftJoin('r.CollectionLines')
                ->where('r.web_page_extract_id = ?', $this->getId());
    
    $results = $query->execute();
    return $results;
  }
  
  /**
   * Retourne les comptabilisation des résultats des tests
   * 
   * @param Doctrine_Collection $results Le rapport fourni par $this->getResults()
   * @return array
   */
  public function getRapport($results=null)
  {
    // *** Initialisation du rapport
    $base_rapport = array(
      'total'             => 0,
      'applicables'       => 0,
      'resultat'          => array(
          Resultat::getLabel(Resultat::ECHEC)    => 0,
          Resultat::getLabel(Resultat::REUSSITE) => 0,
          Resultat::getLabel(Resultat::MANUEL)   => 0,
          Resultat::getLabel(Resultat::NON_EXEC) => 0,
        
          Resultat::getLabel(Resultat::ERREUR)   => 0,
          Resultat::getLabel(Resultat::NA)       => 0,
      )
    );
    
    $rapport = array(
      'total'       => $base_rapport,
      'thematiques' => array()
    );
       
    $thematiques = TestsHelper::getAllThematiques();
    foreach ($thematiques as $thematique)
    {
      $rapport['thematiques'][$thematique] = $base_rapport;
    }
    
    // *** Récupération des résultats si pas fournis
    if ($results == null)
    {
      $results = $this->getResults();
    }
    
    // *** Comptabilisation des résultats
    foreach($results as $testResult)
    {
      $result = $testResult->getResult();
      $test   = $testResult->getClass();
      
      $thematique = $test::getGroup('thematique');
      
      // Incrémentation
      $rapport['total']['total']++;                     // Total
      $rapport['total']['resultat'][Resultat::getLabel($result)]++; // Par résultat
       
      $rapport['thematiques'][$thematique]['resultat'][Resultat::getLabel($result)]++; // Par thématique - par résultat
      $rapport['thematiques'][$thematique]['total']++;                     // Par thématique - total
      
      // Comptabilisation des tests applicables
      if ( $result != Resultat::ERREUR && 
           $result != Resultat::NA     && 
           $result != Resultat::NON_EXEC )
      {
        $rapport['total']['applicables']++;                    // Total applicables
        $rapport['thematiques'][$thematique]['applicables']++; // Total applicables par thématique
      }
    }
    
    // *** Calcul du score

    // Score global
    if ($rapport['total']['applicables'] > 0)
    {
      $rapport['total']['score'] = 100 
                                   * $rapport['total']['resultat'][Resultat::getLabel(Resultat::REUSSITE)] 
                                   / $rapport['total']['applicables'];
    }
    else 
    {
      $rapport['total']['score'] = '-';
    }
    
    // Score par thématique
    foreach($rapport['thematiques'] as $thematique => $rapportThematique)
    {
      if($rapport['thematiques'][$thematique]['applicables'] > 0)
      {
        $rapport['thematiques'][$thematique]['score'] = 100 
                                     * $rapport['thematiques'][$thematique]['resultat'][Resultat::getLabel(Resultat::REUSSITE)] 
                                     / $rapport['thematiques'][$thematique]['applicables'];
      }
      else 
      {
        $rapport['thematiques'][$thematique]['score'] = '-';
      }
    }
    
    return $rapport;
  }
}
