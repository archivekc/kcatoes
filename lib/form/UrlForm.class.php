<?php

use Symfony\Component\Validator\Constraints\UrlValidator;

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
      'url'  => new sfWidgetFormInputText(),
      'conf' => new sfWidgetFormChoice(
        array(
          'choices'   => $confChoices,
          'expanded'  => true
        )
      )
    ));

    $this->setValidators(array(
      'url'  => new KcatoesUrlValidator(),
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
    $this->widgetSchema->setLabel('url', 'Entrez l\'URL à valider');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::configure();
  }
}