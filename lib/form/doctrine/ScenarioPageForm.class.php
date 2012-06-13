<?php

/**
 * ScenarioPage form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Key Consulting
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScenarioPageForm extends BaseScenarioPageForm
{

  public function configure()
  {
    $this->useFields(array('id', 'nom', 'required', 'web_page_id', 'scenario_id'));
    
    $this->setWidgets(array(
     'nom' => new sfWidgetFormInputText()
     ,'required' => new sfWidgetFormInputCheckbox()
     ,'web_page_id' => new sfWidgetFormSelect(array(
        'choices'=> webPageTable::getListUrl()
     ))
     ,'scenario_id' => new sfWidgetFormInputHidden()
    ));
    $this->widgetSchema->setLabels(array(
      'required' => 'Obligatoire'
      ,'web_page_id' => 'Page web'
    ));
    
    $this->setValidator('nom', new sfValidatorString(array('required' => true)));
    
    // Formulaire de nouvelle page web
    $webPageForm = new WebPageForm();
    // Désactive le caractère obligatoire de l'URL pour le sous-formulaire
    $webPageForm->getValidator('url')->setOption('required', false);
    $this->embedForm('newWebPage', $webPageForm);
    
    $this->widgetSchema->setNameFormat('scenarioPage[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    parent::configure();
  }
  
  
  /**
   * Redéfinition de l'enregistrement des éléments des sous-formulaires
   * On supprime le formulaire de WebPage si vide ou si une URL est saisie dans la liste déroulante
   */
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (null === $forms)
    {
      $newWebPage = $this->getValue('newWebPage');
      if ($this->getValue('web_page_id') || !isset($newWebPage['url']))
      {
        unset($this->embeddedForms['newWebPage']);  
      }
    }
   
    return parent::saveEmbeddedForms($con, $forms);
  }
}
