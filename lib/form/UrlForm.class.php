<?php

use Symfony\Component\Validator\Constraints\UrlValidator;
class urlForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'url' => new sfWidgetFormInputText()
    ));

    $this->setValidators(array(
      'url' => new sfValidatorUrl()
    ));

    $this->widgetSchema->setNameFormat('url[%s]');
    $this->widgetSchema->setLabel('url', 'Entrez l\'URL à valider :');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}