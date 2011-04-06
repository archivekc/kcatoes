<?php

/**
 * Thematique form.
 *
 * @package    Kcatoes
 * @subpackage form
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class SelectThematiqueForm extends BaseThematiqueForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'thematique' => new sfWidgetFormDoctrineChoice(array(
        'model' => 'Thematique',
        'method' => 'getLongName',
        'expanded' => true,
        'multiple' => true
      ))
    ));

    $this->widgetSchema->setLabel('thematique', 'Choisissez la ou les thématiques principales des tests que vous souhaitez exécuter :<br />');

    $this->setValidators(array(
      'thematique' => new sfValidatorDoctrineChoice(array(
        'model'  => 'Thematique',
        'multiple' => true,
        'min'      => 1
    ))));

    $this->validatorSchema['thematique']->setMessage('required', 'Vous devez choisir au moins une thématique principale');

    $this->widgetSchema->setNameFormat('selectedThematique[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}
