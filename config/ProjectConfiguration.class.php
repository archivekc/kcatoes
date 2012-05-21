<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony-1.4/lib/autoload/sfCoreAutoload.class.php';

sfCoreAutoload::register();

/**
 * Configuration de KCatoes
 *
 * @package Kcatoes
 * @author Antoine Rolland <antoine.rolland@keyconsulting.fr>
 */
class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->autoloadGoutte();
//    $this->autoloadTest();
    $this->enablePlugins('sfDoctrineGuardPlugin');

    $this->dispatcher->connect('form.post_configure', array($this, 'listenToFormPostConfigure'));
  }

  /**
   *
   * Autoloading des fichiers sources Goutte
   */
  private function autoloadGoutte()
  {
    require_once sfConfig::get('sf_lib_dir').'/vendor/goutte/src/autoload.php';
  }

  /**
   *
   * Autoloading des fichiers sources de tests
   */
  private function autoloadTest()
  {
    require_once sfConfig::get('sf_data_dir').'/implementation/autoload.php';
  }



  /**
   * Listens to the command.post_command event.
   *
   * @param sfEvent An sfEvent instance
   * @static
   */
  static function listenToFormPostConfigure(sfEvent $event)
  {
    sfProjectConfiguration::getActive()->loadHelpers('I18N');

    $form = $event->getSubject();
    $widgetSchema = $form->getWidgetSchema();
    foreach ($form->getValidatorSchema()->getFields() as $fieldName => $validator)
    {
      if (isset($widgetSchema[$fieldName]))
      {
        $label = $widgetSchema[$fieldName]->getLabel() ? $widgetSchema[$fieldName]->getLabel()
            : sfInflector::humanize($fieldName);
        $label = __($label);
        $asterisk = $validator->getOption('required') ? '&nbsp;*' : null;
        $widgetSchema[$fieldName]->setLabel($label . $asterisk . '&nbsp;:');
      }

    }
  }
}
