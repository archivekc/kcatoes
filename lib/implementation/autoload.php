<?php

require_once sfConfig::get('sf_lib_dir').'/vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

//$env = sfContext::getInstance()->getConfiguration()->getEnvironment();

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Implementation' => __DIR__.'/dev',//.$env,
));
//$loader->registerPrefixes(array(
//    'Implementation_' => __DIR__.'/dev',//.$env,
//));
$loader->register();