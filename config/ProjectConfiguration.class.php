<?php

require_once 'C://frameworks//symfony//symfony-1.4.9//lib/autoload/sfCoreAutoload.class.php';
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
}
