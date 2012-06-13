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

  public function configure()
  {
    $this->useFields(array('id', 'url', 'description'));
    
  	$this->setWidgets(array(
  	 'url'          => new sfWidgetFormInputText()
  	 ,'description' => new sfWidgetFormTextarea()
  	 ,'id'          => new sfWidgetFormInputHidden()
  	 ,'src'         => new sfWidgetFormTextarea()
    ));
    
    $this->widgetSchema->setLabels(array('url'         => 'URL',
                                         'src'         => 'Code source',
                                         'description' => 'Description' ));
    
    $this->setValidator('url', new KcatoesUrlValidator(array('required' => true), 
                                                       array('required' => "L'URL est obligatoire",
                                                             'invalid'  => "L'URL est invalide")));
    $this->setValidator('src', new sfValidatorPass(array('required' => false)));
    
    
    // sfValidatorDoctrineUnique
    $this->validatorSchema->getPostValidator()->setMessage('invalid', 'Une page avec la même URL existe déjà.');
    
    $this->widgetSchema->setNameFormat('webPages[%s]');
    
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    parent::configure();
  }
}
