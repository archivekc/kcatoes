<?php

use Symfony\Component\Validator\Constraints\UrlValidator;

/**
 *
 * Enter description here ...
 * @author Adrien
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
    $this->setWidgets(array(
      'url' => new sfWidgetFormInputText()
    ));

    $this->setValidators(array(
      'url' => new KcatoesUrlValidator()
    ));

    $this->widgetSchema->setNameFormat('userUrl[%s]');
    $this->widgetSchema->setLabel('url', 'Entrez l\'URL à valider :');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::configure();
  }
}