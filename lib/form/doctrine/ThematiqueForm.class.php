<?php

/**
 * Thematique form.
 *
 * @package    Kcatoes
 * @subpackage form
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class ThematiqueForm extends BaseThematiqueForm
{
  public function configure()
  {
    $this->useFields();
    $this->setWidgets(array(
      'thematique' => new sfWidgetFormChoice(array(
        'choices'  => Doctrine_Core::getTable('Thematique')->getNom(),
        'expanded' => true,
        'multiple' => true
      ))
    ));

    $this->setValidators(array(
      'thematique' => new sfValidatorChoice(array(
        'choices' => Doctrine_Core::getTable('Thematique')->getNom()
    ))));

    $this->widgetSchema->setNameFormat('selectedThematique[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
