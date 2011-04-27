<?php

/**
 * Test form.
 *
 * @package    Kcatoes
 * @subpackage form
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class TestForm extends BaseTestForm
{
  /**
   * (non-PHPdoc)
   * @see lib/form/BaseForm::configure()
   */
  public function configure()
  {
    $choices = array('' => false, Resultat::REUSSITE => 'Réussite', Resultat::ECHEC => 'Echec');
    $this->widgetSchema['execute_si'] = new sfWidgetFormChoice(array(
      'choices' => $choices
    ));

    $this->validatorSchema['execute_si'] = new sfValidatorChoice(array(
      'choices'  => array_keys($choices),
      'required' => false
    ));

    $this->validatorSchema->setPostValidator(
      new KcatoesDependanceValidator(array('model' => 'Test', 'column' => array('nom')))
    );
  }
}
