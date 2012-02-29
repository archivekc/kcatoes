<?php

class kcatoesTestTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
      new sfCommandOption('url', null, sfCommandOption::PARAMETER_OPTIONAL, 'L\'url de la page à tester', null),
      new sfCommandOption('html', null, sfCommandOption::PARAMETER_OPTIONAL, 'Code source à tester', null),
      new sfCommandOption('conf', null, sfCommandOption::PARAMETER_REQUIRED, 'Fichier de config des tests à passer', null),
      new sfCommandOption('output', null, sfCommandOption::PARAMETER_REQUIRED, 'type de sortie (html, richHtml, csv, json)', 'html'),
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
  	// définition de la zone horaire
  	date_default_timezone_set('Europe/Paris');
  	
    // liste des plugins et tests associés
    $allPluginPath = sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'kcatoesPlugins';
  	$allPluginsFilename = $allPluginPath.DIRECTORY_SEPARATOR.'allPlugins.yml';
  	$allPlugins = sfYaml::load(file_get_contents($allPluginsFilename));
  	
  	// chargement des classes utiles
  	$tests = getTestsClass($allPlugins);
  	getRequired($allPluginPath);
  	// outil
  	
  	// initialisation et lancement des tests
  	$kcatoes = new KcatoesWrapper($tests, $options['html'], $options['url']);
  	$results = $kcatoes->run();
  	
  	// resultats
  	$output = $kcatoes->output($options['output']);

  	// formats de sortie
    $tplPath = '.'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'kcatoesOutput'.DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR;
  	
  	switch($options['output'])
  	{
  		case 'html':
  			$tpl = file_get_contents($tplPath.'/simple.html');
  			
  			echo generateRapportHtml(array(
                           'table' => $output
                           ,'title' => 'KCatoès - Rapport de test'
                           ,'subtitle' => ($options['url']?$options['url']:'').' '.date('d/m/Y H:i')
                          ), $tpl); 
  			break;
      case 'rich':
		    session_start();
		    $tmpPath = '.'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'kcatoesOutput'.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR;
		    $userTmpPath = $tmpPath.session_id().DIRECTORY_SEPARATOR;
		    
      	exec('mkdir '.$userTmpPath);

        $tpl = file_get_contents($tplPath.'/rich.html');
        
        file_put_contents($userTmpPath.'/output.html'
                         ,generateRapportHtml(array(
                           'table' => $output
                           ,'title' => 'KCatoès - Rapport de test'
                           ,'subtitle' => ($options['url']?$options['url']:'').' '.date('d/m/Y H:i')
                          ), $tpl));
        file_put_contents($userTmpPath.'/tested.html', $kcatoes->getRawContent($options['url']));
        exec('cp -R '.$tplPath.'/img '.$userTmpPath.'/img');
        exec('cp -R '.$tplPath.'/css '.$userTmpPath.'/css');
        exec('cp -R '.$tplPath.'/js '.$userTmpPath.'/js');
        break;
  		default:
  			echo $output;
  	}
  }
}

function getTestsClass(array $testsByPluginAndRubrique)
{
	$tests = array();
	foreach ($testsByPluginAndRubrique as $plugin => $testsByRubrique)
	{
	  foreach ($testsByRubrique as $rubrique => $listTest)
	  {
	     foreach ($listTest as $test)
	    {
	      array_push($tests, 'Kcatoes\\'.$plugin.'\\'.$test);
	    }
	  }
	}
	return $tests;
}

function getRequired($allPluginPath)
{
   if ($handleAll = opendir($allPluginPath))
    {
      while (false !== ($entryPlugin = readdir($handleAll))) {
          if ($entryPlugin != '.' && $entryPlugin != '..' && is_dir($allPluginPath.DIRECTORY_SEPARATOR.$entryPlugin)){
            if ($handle = opendir($allPluginPath.DIRECTORY_SEPARATOR.$entryPlugin))
            {
              while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                {
                  require_once $allPluginPath.DIRECTORY_SEPARATOR.$entryPlugin.DIRECTORY_SEPARATOR.$entry;
                }
              }
            }
          }
      }
    }
}

function generateRapportHtml(array $data, $tpl)
{
	foreach ($data as $key => $value)
	{
		  $tpl = str_replace('###'.strtoupper($key).'###', $value, $tpl);
	}
 
	return $tpl;
}