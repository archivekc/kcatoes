<?php

class TestsHelper {

  public function __construct()
  {
    throw new KcatoesException('La classe TestsHelper n\'est pas prévue pour être instanciée');
  }
  
  
  /******************************************************************************************
   * Fonctions d'identification des tests 
   */
  
	/**
	 * Identifie la liste des tests disponibles et la retourne sous la forme : 
   *  array(
   *    'Kcatoes\rgaa\AbsenceDAttributsOuDElementsHtmlDePresentation', 
   *    'Kcatoes\rgaa\AbsenceInterruptionHierarchieTitres', 
   *    ... ) 
	 * 
	 * @return array
	 */	
  public static function getAllTestsFromYaml()
  {
    $allPluginPath = sfConfig::get('app_pluginpath');
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
   *    ... )
   *    
   * @return array
   */
  public static function getAllTestsFromDir()
  {
    $allTests = array();
    
    $allPluginPath = sfConfig::get('app_pluginpath');
    if ($handleAll = opendir($allPluginPath))
    {
    	// Parcours des plugins (ex: rgaa)
      while (false !== ($plugin = readdir($handleAll)))
      {
        if ($plugin != '.' && $plugin != '..' && is_dir($allPluginPath.DIRECTORY_SEPARATOR.$plugin))
        {
          if ($handle = opendir($allPluginPath.DIRECTORY_SEPARATOR.$plugin))
          {
            while (false !== ($entry = readdir($handle)))
            {
              if ($entry != '.' && $entry != '..')
              {
                $allTests[] = 'Kcatoes'.'\\'.$plugin.'\\'.str_replace('.class.php', '', $entry);
              }
            }
          }
        }
      }
    }
    return $allTests;
  }
  
  
	/**
	 * Retourne une liste des classes (avec namespace) à partir du tableau de conf issu du YAML
	 * 
	 * @param array $testsByPluginAndRubrique
	 * @return array
	 */
	public static function getTestsClassFromTab(array $testsByPlugin)
	{
	  $tests = array();
	  foreach ($testsByPlugin as $plugin => $testsList)
	  {
	    foreach ($testsList as $test)
	    {
        array_push($tests, 'Kcatoes\\'.$plugin.'\\'.$test);
	    }
	  }
	  return $tests;
	}
	
	
	/**
	 * Chargement des classes de test (à partir du répertoire de plugins) 
	 * 
	 * @param string $allPluginPath
	 */
	public static function getRequired($allPluginPath = null)
	{
		if ($allPluginPath === null) {
      $allPluginPath = sfConfig::get('app_pluginpath');
		}
		if ($handleAll = opendir($allPluginPath))
		{
			while (false !== ($plugin = readdir($handleAll))) {
				if ($plugin != '.' && $plugin != '..' && is_dir($allPluginPath.DIRECTORY_SEPARATOR.$plugin)){
					if ($handle = opendir($allPluginPath.DIRECTORY_SEPARATOR.$plugin))
					{
						while (false !== ($entry = readdir($handle))) {
							if ($entry != '.' && $entry != '..')
							{
								require_once $allPluginPath.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.$entry;
							}
						}
					}
				}
			}
		}
	}

	/******************************************************************************************
	 * Fonctions utiles pour la génération 
	 */
	
	
  /**
   * Génération du rapport à partir des résultats et de la template
   * @param array $data
   * @param string $tpl
   * @return string
   */
  public static function generateRapportHtml(array $data, $tpl)
  {
    foreach ($data as $key => $value)
    {
        $tpl = str_replace('###'.strtoupper($key).'###', $value, $tpl);
    }
    return $tpl;
  }
  
  /**
   * Génération du rapport à partir des résultats et de la template
   * avec historisation (commentaire, etc)
   * 
   * @param array $data
   * @param string $tpl
   * @return string
   */
	public static function generateHistorize($fields, $tpl)
	{
	  $str = <<<'EOT'
	  $fields = array();
	  $fields['select'] = array();
	  $fields['textarea'] = array();
EOT;

	  foreach ($fields['select'] as $field)
	  {                          
	    $str .= '$fields[\'select\'][]=\''.$field.'\';'."\n";
	  }
	  foreach ($fields['textarea'] as $field)
	  {                          
	    $str .= '$fields[\'textarea\'][]=\''.$field.'\';'."\n";
	  }
	  return str_replace('###FIELDS###', $str, $tpl);
	}
  
	
  /******************************************************************************************
   * Fonctions utiles pour le système de fichiers 
   */
	
	/**
	 * Copie récursive de fichiers 
	 * @param string $src  Source
	 * @param string $dst  Destination
	 */
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
	
	/**
	 * Suppression de répertoire
	 * @param string $dir  Le répertoire à supprimer
	 */
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