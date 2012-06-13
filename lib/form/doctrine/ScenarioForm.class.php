<?php

/**
 * Scenario form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Key Consulting
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScenarioForm extends BaseScenarioForm
{

  public function configure()
  {
    $this->useFields(array('id', 'nom'));
    
    $this->widgetSchema['nom'] = new sfWidgetFormInputText();
    $this->widgetSchema['template'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'scenarioTemplate'
        ,'add_empty' => true
        ,'order_by' => array('nom', 'asc')
        ,'multiple' => false        
      ));
    
    $this->validatorSchema['nom'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['template'] = new sfValidatorPass(array('required' => false));
    
    $this->widgetSchema->setLabels(array('template' => 'Utiliser un modèle de scénario'));

    parent::configure();
  }
}
