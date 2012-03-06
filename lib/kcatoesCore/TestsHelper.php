<?php

class TestsHelper {

  public function __construct()
  {
    throw new KcatoesException('La classe TestsHelper n\'est pas prévue pour être instanciée');
  }
  
  static public function getLibelle($classname)
  {
    if (class_exists($classname, false))
    {
      return $classname::testName;
    }
    return false;
  }
  
	/**
	 * Identifie la liste des tests disponibles et la retourne sous la forme : 
   *  array(
   *    'Kcatoes\rgaa\AbsenceDAttributsOuDElementsHtmlDePresentation', 
   *    'Kcatoes\rgaa\AbsenceInterruptionHierarchieTitres', 
   *    'Kcatoes\rgaa\AbsenceCadreNonTitres', 
   *    'Kcatoes\rgaa\PertinenceTitresCadres' ) 
	 * 
	 * @return array
	 */	
  public static function getAllPlugins()
  {
    //$allPluginPath = sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'kcatoesPlugins';
    $allPluginPath = sfConfig::get('app_pluginpath');
    
    // TODO : se passer du YAML ? ( cf. getAllTests() )
    $allPluginsFilename = $allPluginPath.DIRECTORY_SEPARATOR.'allPlugins.yml';
    $allPlugins = sfYaml::load(file_get_contents($allPluginsFilename));

    return $allPlugins; 
  }
  
  /**
   * Recherche la liste des tests disponibles dans le répertoire de plugins
   * et la retourne sous la forme : 
   *  array(
   *    'Kcatoes\rgaa\AbsenceDAttributsOuDElementsHtmlDePresentation', 
   *    'Kcatoes\rgaa\AbsenceInterruptionHierarchieTitres', 
   *    'Kcatoes\rgaa\AbsenceCadreNonTitres', 
   *    'Kcatoes\rgaa\PertinenceTitresCadres' )
   *    
   * @return array
   */
  public static function getAllTests()
  {
    $allTests = array();
    
    $allPluginPath = sfConfig::get('app_pluginpath');
    if ($handleAll = opendir($allPluginPath))
    {
      while (false !== ($entryPlugin = readdir($handleAll)))
      {
        if ($entryPlugin != '.' && $entryPlugin != '..' && is_dir($allPluginPath.DIRECTORY_SEPARATOR.$entryPlugin))
        {
          if ($handle = opendir($allPluginPath.DIRECTORY_SEPARATOR.$entryPlugin))
          {
            while (false !== ($entry = readdir($handle)))
            {
              if ($entry != '.' && $entry != '..')
              {
                $allTests[] = 'Kcatoes'.DIRECTORY_SEPARATOR.$entryPlugin.DIRECTORY_SEPARATOR.str_replace('.class.php', '', $entry);
              }
            }
          }
        }
      }
    }
    return $allTests;
  }
  
  
	/**
	 * Récupère
	 * 
	 * @param array $testsByPluginAndRubrique
	 * @return array
	 */
	public static function getTestsClass(array $testsByPluginAndRubrique)
	{
	  $tests = array();
	  foreach ($testsByPluginAndRubrique as $plugin => $testsByRubrique)
	  {
	    foreach ($testsByRubrique as $rubrique => $listTest)
	    {
        foreach ($listTest as $test)
	      {
	        //array_push($tests, 'Kcatoes\\'.$plugin.'\\'.$test);
	        array_push($tests, 'Kcatoes'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.$test);
	      }
	    }
	  }
	  return $tests;
	}
	
	/**
	 * Chargement des classes de test 
	 * 
	 * @param unknown_type $allPluginPath
	 * @return unknown_type
	 */
	public static function getRequired($allPluginPath = null)
	{
		if ($allPluginPath === null) {
      $allPluginPath = sfConfig::get('app_pluginpath');
		}
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

	
	// copies files and non-empty directories
	public static function rcopy($src, $dst) {
	  if (file_exists($dst)) self::rrmdir($dst);
	  if (is_dir($src)) {
	    mkdir($dst);
	    $files = scandir($src);
	    foreach ($files as $file)
	    if ($file != "." && $file != "..") self::rcopy("$src/$file", "$dst/$file");
	  }
	  else if (file_exists($src)) copy($src, $dst);
	}
	
	// removes files and non-empty directories
	public static function rrmdir($dir) {
	  if (is_dir($dir)) {
	    $files = scandir($dir);
	    foreach ($files as $file)
	    if ($file != "." && $file != "..") self::rrmdir("$dir/$file");
	    rmdir($dir);
	  }
	  else if (file_exists($dir)) unlink($dir);
	} 

	
}