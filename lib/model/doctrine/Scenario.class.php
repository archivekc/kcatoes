<?php

/**
 * Scenario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    kcatoes
 * @subpackage model
 * @author     Key Consulting
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Scenario extends BaseScenario
{

	public function getScenarioPagesInfo()
	{
    $pageInfo = Doctrine_Query::create()
      ->select('sp.required, sp.nom, wp.url, e.type, t.class as tests')
      //->from('Scenario s')
      ->from('ScenarioPage sp')
      ->leftJoin('sp.WebPage wp, wp.CollectionExtracts e, e.CollectionResults t')
      ->where('sp.scenario_id = ?', $this->getId())
      ->orderBy('sp.created_at ASC, e.type ASC')
      ->execute();
    
		return $pageInfo;
	}
	
}