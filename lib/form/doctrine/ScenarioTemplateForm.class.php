<?php

/**
 * ScenarioTemplate form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Key Consulting
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScenarioTemplateForm extends BaseScenarioTemplateForm
{
	public function setup()
	{
		parent::setup();
		unset($this['created_at'],$this['updated_at']);
	}
	
  public function configure()
  {
    $this->setWidgets(array(
     'nom' => new sfWidgetFormInputText()
    ));
    
    $this->setValidator('nom', new sfValidatorString(array('required' => true),
                                                     array('required' => 'Un nom de template est obligatoire')));
    
    $this->widgetSchema->setNameFormat('scenarioTemplate[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}
