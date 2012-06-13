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

  public function configure()
  {
    $this->useFields(array('id', 'nom'));
    
    $this->setWidgets(array(
     'nom' => new sfWidgetFormInputText()
    ));
    
    $this->setValidator('nom', new sfValidatorString(array('required' => true),
                                                     array('required' => 'Le nom du modèle est obligatoire')));
    
    $this->widgetSchema->setNameFormat('scenarioTemplate[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}
