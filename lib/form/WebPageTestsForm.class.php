<?php
class WebPageTestsForm extends BaseWebPageForm
{
  public function configure()
  {
    $this->useFields(array('id'));
    
    $this->setWidgets(array(
      'id' => new sfWidgetFormInputHidden()
    ));
    
    // Ajout des checkboxes de chaque test
    $allTests = TestsHelper::getAllTestsFromDir();

    // Parcours des tests disponibles
    foreach($allTests as $testClass) {
      // Coche la case si le test est déjà lié à la page
      $checked = (!$this->isNew() && $this->getObject()->hasTest($testClass)) ? 'checked' : '';
      
      $this->widgetSchema[$testClass]    = new sfWidgetFormInputCheckbox(array(), array('checked' => $checked));

      // TODO : validation
      $this->validatorSchema[$testClass] = new sfValidatorPass(array('required' => false));
      
      // TODO : autre label ?
      $this->widgetSchema->setLabel($testClass, $testClass::getIdLibelle().' ('.$testClass::getGroup('niveau').')');
    }
    
    $this->widgetSchema->setNameFormat('webPageTests[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
  

  
  
}