<?php

/**
 * Formulaire de sélection de regroupement
 *
 * @package    Kcatoes
 * @subpackage form
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class SelectRegroupementForm extends BaseRegroupementForm
{
  public function configure()
  {
    $referentiels = $this->getOption('referentiel');

    $query = Doctrine_Core::getTable('regroupement')->createQuery()->select()->whereIn('referentiel_id', $referentiels)->orderBy('nom');

    $this->setWidgets(array(
      'regroupement' => new sfWidgetFormDoctrineChoice(array(
        'model'    => 'Regroupement',
        'method'   => 'getNom',
        'query'    => $query,
        'expanded' => true,
        'multiple' => true
      ))
    ));

    $this->widgetSchema->setLabel('regroupement', 'Choisissez le ou les regroupements des tests que vous souhaitez exécuter :<br />');

    $this->setValidators(array(
      'regroupement' => new sfValidatorDoctrineChoice(array(
        'model'    => 'Regroupement',
        'query'    => $query,
        'multiple' => true,
        'min'      => 1
    ))));

    $this->validatorSchema['regroupement']->setMessage('required', 'Vous devez choisir au moins un regroupement');

    $this->widgetSchema->setNameFormat('selectedRegroupement[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}
