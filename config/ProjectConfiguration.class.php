<?php

require_once 'C://frameworks//symfony//symfony-1.4.9//lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');

    //Autloading Goutte
    require_once sfConfig::get('sf_lib_dir').'\vendor\goutte\src\autoload.php';
  }
}
