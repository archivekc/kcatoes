<?php

/**
 * WebPage form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class WebPageForm extends BaseWebPageForm
{
	public function setup(){
		parent::setup();
		unset(
		  $this['created_at']
		  ,$this['updated_at']
		  ,$this['doctype']
		  ,$this['basesrc']
	  );
	}
	
  public function configure()
  {
  	$this->setWidgets(array(
  	 'url' => new sfWidgetFormInputText()
  	 ,'description' => new sfWidgetFormTextarea()
  	 ,'id' => new sfWidgetFormInputHidden()
  	 ,'src' => new sfWidgetFormTextarea()
    ));
    
    $this->setValidator('url', new KcatoesUrlValidator());
    $this->setValidator('src', new sfValidatorPass(array('required' => false)));
    $this->widgetSchema->setLabels(array('src' => 'Code source'));
    
    $this->widgetSchema->setNameFormat('webPages[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}
