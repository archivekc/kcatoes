<?php

/**
 * Assoc_WebPage_TestConfig form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Assoc_WebPage_TestConfigForm extends BaseAssoc_WebPage_TestConfigForm
{
  public function configure()
  {
  	unset(
			$this['created_at'],
			$this['udpated_at']
  	);
  	
  	$testConfigs = Doctrine_Core::getTable('TestConfig')->getAllForSelect();
  	                                                         
  	$this->setWidgets(array(
      'test_config_id'  => new sfWidgetFormChoice(array('choices'   => $testConfigs)),
      'web_page_id'     => new sfWidgetFormInputHidden()
  	));
  	
  	
    $this->setValidators(array(
      'test_config_id' => new sfValidatorChoice(array(
                            'required' => true,
                            'choices' => array_keys($testConfigs)),array(
                            'required' => 'Sélection d\'une configuration obligatoire')),
    
      'web_page_id' => new sfValidatorDoctrineChoice(
                        array('required' => true, 'model' => 'WebPage', 'column' => 'id'),
                        array('required' => 'Impossible d\'identifier la page associée',
                              )),
                            
    ));
  	
    $this->widgetSchema->setNameFormat('assoc_webpage_testconfig[%s]');
    parent::configure();
  }
  
  
  /**
   * Redéfinit la méthode pour mettre à jour la liste de configurations de tests 
   * disponibles pour la page web courante
   * @param string $name
   * @param mixed $default
   * @return Assoc_WebPage_TestConfigForm
   */
  public function setDefault($name, $default){
  	if ($name == 'web_page_id') {
  		// Met à jour la liste 
      $testConfigs = Doctrine_Core::getTable('TestConfig')->getAvailableForSelect($default);
  		$this->widgetSchema['test_config_id'] = new sfWidgetFormChoice(array( 'choices'   => $testConfigs));
  	}
  	parent::setDefault($name, $default);
  	return $this;
  }
  	

}
