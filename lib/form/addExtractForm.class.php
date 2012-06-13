<?php
class addExtractForm extends BaseWebPageExtractForm
{
    
  public function configure()
  {
    $this->useFields(array('web_page_id', 'src'));

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
    
  	parent::configure();
  }
}