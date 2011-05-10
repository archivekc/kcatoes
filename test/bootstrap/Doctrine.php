<?php

include(dirname(__FILE__).'/unit.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
new sfDatabaseManager($configuration);
Doctrine::dropDatabases();
Doctrine::createDatabases();
Doctrine::loadModels(sfConfig::get('sf_lib_dir') . '/model/doctrine', Doctrine::MODEL_LOADING_CONSERVATIVE);
Doctrine::createTablesFromArray(Doctrine::getLoadedModels());
Doctrine::loadData(sfConfig::get('sf_test_dir').'/fixtures');

// remove all cache
sfToolkit::clearDirectory(sfConfig::get('sf_app_cache_dir'));
