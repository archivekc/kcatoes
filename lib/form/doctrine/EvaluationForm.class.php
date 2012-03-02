<?php

/**
 * Evaluation form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EvaluationForm extends BaseEvaluationForm
{
  public function setup(){
    parent::setup();
    unset(
      $this['created_at']
      ,$this['updated_at']
    );
  }
  public function configure()
  {
  	$table  = Doctrine_Core::getTable('TestConfig');
    $q = Doctrine_Query::create()
     ->from('TestConfig c')
     ->innerJoin('c.CollectionTests d')
     ->orderBy('c.libelle ASC');
  	$configs = $q->fetchArray();
  	
  	$choices = array();
  	foreach($configs as $config)
  	{
  		$choices[$config['id']] = $config['libelle'];
  	}
     
    $this->setWidgets(array(
     'config_id' => new sfWidgetFormChoice(array('choices'=>$choices))
     ,'id' => new sfWidgetFormInputHidden()
     ,'web_page_id' => new sfWidgetFormInputHidden()
    ));
    
    $this->widgetSchema->setNameFormat('evaluation[%s]');
    parent::configure();
  }
}
