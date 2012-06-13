<?php

/**
 * TestConfig form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TestConfigForm extends BaseTestConfigForm
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
    $this->useFields(array('id', 'libelle', 'description'));
    
    $this->setWidgets(array(
     'libelle' => new sfWidgetFormInputText()
     ,'description' => new sfWidgetFormTextarea()
     ,'id' => new sfWidgetFormInputHidden()
    ));
    
    $this->widgetSchema->setNameFormat('testConfigs[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}
