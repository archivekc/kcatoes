<?php
class addExtractForm extends BaseWebPageExtractForm
{
  public function setup(){
    parent::setup();
    unset(
      $this['id']
      ,$this['created_at']
      ,$this['updated_at']
      ,$this['type']
    );    
  }
    
  public function configure()
  {
  	parent::configure();
  	$this->setWidgets(array(
  	  'web_page_id' => new sfWidgetFormInputHidden()
  	  ,'src' => new sfWidgetFormInputHidden()
  	 ,
    ));
    
    $this->setValidators(array(
      'web_page_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WebPage'))),
      'src'         => new sfValidatorString(),
    ));
    
    $this->widgetSchema->setNameFormat('webPageExtract[%s]');
    
  }
}