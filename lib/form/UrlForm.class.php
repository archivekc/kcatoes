<?php

use Symfony\Component\Validator\Constraints\UrlValidator;
class UrlForm extends sfForm
{
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
  }
}