<?php

/**
 * Formulaire d'import de configuration
 *
 * @package    Kcatoes
 * @subpackage form
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class ImportForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'configFile' => new sfWidgetFormInputFile(array(
        'label'    => 'Choisissez le fichier de configuration à utiliser'
      ))
    ));

    $this->setValidators(array(
      'configFile' => new sfValidatorFile(
        array(
          'path'       => sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'config',
          'required'   => true
        ),
        array(
          'required'   => 'Vous devez choisir un fichier de configuration'
        )
      )
    ));

    $this->widgetSchema->setNameFormat('import[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}