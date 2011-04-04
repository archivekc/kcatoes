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
  public function configure()
  {
    $regroupements = $this->getOption('regroupement');

    $query = Doctrine_Core::getTable('test')->createQuery()->select()->whereIn('regroupement_id', $regroupements);

    $this->setWidgets(array(
      'test' => new sfWidgetFormDoctrineChoice(array(
        'model'    => 'Test',
        'method'   => 'getLongName',
        'query'    => $query,
        'expanded' => true,
        'multiple' => true
      ))
    ));

    $this->widgetSchema->setLabel('test', 'Choisissez le ou les tests que vous souhaitez exécuter :<br />');

    $this->setValidators(array(
      'test' => new sfValidatorDoctrineChoice(array(
        'model'    => 'Test',
        'query'    => $query,
        'multiple' => true,
        'min'      => 1
    ))));

    $this->validatorSchema['test']->setMessage('required', 'Vous devez choisir au moins un test');

    $this->widgetSchema->setNameFormat('selectedTest[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}
