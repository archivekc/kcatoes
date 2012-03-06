<?php

class kcatoesTestTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'Le nom de l\'application', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'L\'environnement (dev|prod|..)', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'Le type de connexion (doctrine|propel)', 'doctrine'),
      // add your own options here
      new sfCommandOption('url', null, sfCommandOption::PARAMETER_OPTIONAL, 'L\'url de la page à tester', null),
      new sfCommandOption('html', null, sfCommandOption::PARAMETER_OPTIONAL, 'Code source à tester', null),
      new sfCommandOption('conf', null, sfCommandOption::PARAMETER_REQUIRED, 'Fichier de config des tests à passer', null),
      new sfCommandOption('output', null, sfCommandOption::PARAMETER_REQUIRED, 'type de sortie (html, richHtml, csv, json)', 'html'),
      new sfCommandOption('history', null, sfCommandOption::PARAMETER_OPTIONAL, 'fonctionnalité de sauvegarde des saisies utilisateurs', null),
    ));

    $this->namespace        = 'kcatoes';
    $this->name             = 'test';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [kcatoes:test|INFO] task does things.
Call it with:

  [php symfony kcatoes:test|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    session_start();
  	// définition de la zone horaire
  	date_default_timezone_set('Europe/Paris');
  	
  	
    // liste des plugins et tests associés
    $allPluginPath = sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'kcatoesPlugins';
  	$allPluginsFilename = $allPluginPath.DIRECTORY_SEPARATOR.'allPlugins.yml';
  	$allPlugins = sfYaml::load(file_get_contents($allPluginsFilename));
  	
  	if (isset($options['conf']) && $options['conf'] != null && file_exists($options['conf']) ) {
  		// Chargement du fichier de configuration
  		$testList = KcatoesWrapper::loadConf($options['conf']);    
  	} 
  	else {
  		// Tous les tests
  		$testList = $allPlugins;
  	}

  	// chargement des classes (format avec namespace)
  	$tests = TestsHelper::getTestsClassFromTab($testList);
      
  	TestsHelper::getRequired($allPluginPath);
  	
  	// initialisation et lancement des tests
    KcatoesWrapper::execute($tests, $options, 'task');
  }
}





