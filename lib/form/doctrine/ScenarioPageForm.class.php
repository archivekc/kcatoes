<?php

/**
 * ScenarioPage form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Key Consulting
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScenarioPageForm extends BaseScenarioPageForm
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
    parent::configure();
    $this->setWidgets(array(
     'nom' => new sfWidgetFormInputText()
     ,'required' => new sfWidgetFormInputCheckbox()
     ,'web_page_id' => new sfWidgetFormSelect(array(
        'choices'=> webPageTable::getListUrl()
     ))
     ,'scenario_id' => new sfWidgetFormInputHidden()
    ));
    $this->widgetSchema->setLabels(array(
      'required' => 'Obligatoire'
      ,'web_page_id' => 'Page web'
    ));
    
    $this->setValidator('nom', new sfValidatorString(array('required' => true)));
    
    $this->widgetSchema->setNameFormat('scenarioPage[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
