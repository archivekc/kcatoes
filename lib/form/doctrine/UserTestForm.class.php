<?php

/**
 * ProfilTest form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Key Consulting
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserTestForm extends BaseSfGuardGroupForm
{
	public function __construct($tests, $defaults, $options, $CSRFSecret)
	{
		parent:: __construct($defaults, $options, $CSRFSecret);
		$this->tests = $tests;
	}


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
    	$isProfilLinked = false;
    	if (!$this->isNew() && in_array($testClass, $this->tests))
    	{
    		$isProfilLinked = true;
    	}
      // Coche la case si le test est déjà lié au profil
      //$checked = (!$this->isNew() && $this->getObject()->hasTest($testClass)) ? 'checked' : '';
      
    	if ($isProfilLinked)
    	{
	      $this->widgetSchema[$testClass]    = new sfWidgetFormInputCheckbox(array(), array('checked' => 'checked', 'disabled' => 'disabled'));
    	}
    	else
    	{
    		$this->widgetSchema[$testClass]    = new sfWidgetFormInputCheckbox(s);
    	}

      // TODO : validation
      $this->validatorSchema[$testClass] = new sfValidatorPass(array('required' => false));
      
      // TODO : autre label ?
      $this->widgetSchema->setLabel($testClass, $testClass::getIdLibelle().' ('.$testClass::getGroup('niveau').')');
    }
    
    $this->widgetSchema->setNameFormat('UserTest[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}
