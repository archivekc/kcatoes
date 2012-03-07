<?php

/**
 * Formulaire de saisie de l'URL de la page à tester
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class UrlForm extends BaseForm
{
  /**
   * (non-PHPdoc)
   * @see sfForm::configure()
   */
  public function configure()
  {
    $confChoices = array(
      'wizard' => 'Configuration manuelle',
      'import' => 'Utiliser un fichier de configuration'
    );

    $this->setWidgets(array(
      'url'      => new sfWidgetFormInputText(
        array(
          'label' => 'Entrez l\'URL à valider'
        )
      ),
      'htmlFile' => new sfWidgetFormInputFile(
        array(
          'label' => 'Ou sélectionnez un fichier HTML à tester'
        )
      ),
      'conf'     => new sfWidgetFormChoice(
        array(
          'choices'   => $confChoices,
          'expanded'  => true
        )
      )
    ));

    $this->setValidators(array(
      'url'  => new KcatoesUrlValidator(
        array(
          'required' => false
        )
      ),
      'htmlFile' => new sfValidatorFile(
        array(
          'path'     => sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'html',
          'required' => false
        )
      ),
      'conf' => new sfValidatorChoice(
        array(
          'choices'  => array_keys($confChoices),
          'required' => true
        ),
        array(
          'required' => 'Vous devez choisir une méthode de configuration'
        )
      )
    ));

    $this->widgetSchema->setNameFormat('userUrl[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
  }
}