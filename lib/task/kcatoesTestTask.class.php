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
      new sfCommandOption('output', null, sfCommandOption::PARAMETER_REQUIRED, 'type de sortie (html, richHtml, csv, json)', 'html'),
      new sfCommandOption('history', null, sfCommandOption::PARAMETER_OPTIONAL, 'fonctionnalité de sauvegarde des saisies utilisateurs', null),
      new sfCommandOption('conf', null, sfCommandOption::PARAMETER_REQUIRED, "Fichier de config des tests à passer, au format Yaml", null),
    ));

    $this->namespace        = 'kcatoes';
    $this->name             = 'test';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
    
La tâche [kcatoes:test|INFO] lance les tests d'accessibilité sur une page donnée.
La liste des tests implémentée est dans le répertoire lib/kcatoesPlugins/
Le fichier de configuration est au format Yaml. 
Exemple : 
+---------------------------------------------------+
|rgaa:                                              |
|  - AbsenceDAttributsOuDElementsHtmlDePresentation |
|  - AbsenceInterruptionHierarchieTitres            |
|  - AbsenceCadreNonTitres                          |
|  - PertinenceTitresCadres                         |
+---------------------------------------------------+
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    session_start();
  	// définition de la zone horaire
  	date_default_timezone_set('Europe/Paris');
  	 	
    // liste des plugins et tests associés
  	$allPlugins = TestsHelper::getAllTestsFromYaml();
  	
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
      
  	// Inclusion des classes de test
  	TestsHelper::getRequired();
  	
  	// initialisation et lancement des tests
    KcatoesWrapper::execute($tests, $options, 'task');
  }
}





