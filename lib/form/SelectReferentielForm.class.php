<?php

/**
 * Formulaire de sélection de référentiel
 *
 * @package    Kcatoes
 * @subpackage form
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class SelectReferentielForm extends BaseReferentielForm
{
  public function configure()
  {
    $thematiques = $this->getOption('thematiques');

    $query = Doctrine_Core::getTable('referentiel')->createQuery()->select()->whereIn('thematique_id', $thematiques)->orderBy('nom');

    $this->setWidgets(array(
      'referentiel' => new sfWidgetFormDoctrineChoice(array(
        'model'    => 'Referentiel',
        'method'   => 'getLongName',
        'query'    => $query,
        'expanded' => true,
        'multiple' => true
      ))
    ));

    $this->widgetSchema->setLabel('referentiel', 'Choisissez le ou les référentiels des tests que vous souhaitez exécuter :<br />');

    $this->setValidators(array(
      'referentiel' => new sfValidatorDoctrineChoice(array(
        'model'    => 'Referentiel',
        'query'    => $query,
        'multiple' => true,
        'min'      => 1
    ))));

    $this->validatorSchema['referentiel']->setMessage('required', 'Vous devez choisir au moins un référentiel');

    $this->widgetSchema->setNameFormat('selectedReferentiel[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}