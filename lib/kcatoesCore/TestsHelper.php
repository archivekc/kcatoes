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
  
  public static function getReferencesFromYaml()
  {
    $allPluginPath = sfConfig::get('app_pluginpath');
    $referencesFile = $allPluginPath.DIRECTORY_SEPARATOR.'references.yml';
    $references = sfYaml::load(file_get_contents($referencesFile));

    return $references;
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
    self::getRequired();
    
    $allTests = array();
    
    $allPluginPath = sfConfig::get('app_pluginpath');
    
    if ($handleAll = opendir($allPluginPath))
    {
      // Parcours des plugins (ex: rgaa)
      while (false !== ($plugin = readdir($handleAll)))
      {
        if ($plugin != '.' && $plugin != '..' && is_dir($allPluginPath.DIRECTORY_SEPARATOR.$plugin))
        {
          self::getTestsFromDir($allTests, $allPluginPath.DIRECTORY_SEPARATOR.$plugin, $plugin);
        }
      }
    }
    
    return $allTests;
  }
  
  /**
   * Recherche les tests disponibles dans un répertoire (récursivement)
   * @param string $dir
   * @return array
   */
  private static function getTestsFromDir(&$allTests, $dir, $plugin='') {
          
    if ($handle = opendir($dir))
    {
      while (false !== ($entry = readdir($handle)))
      {
        if ($entry != '.' && $entry != '..')
        {
          if (is_dir($dir.DIRECTORY_SEPARATOR.$entry))
          {
            self::getTestsFromDir($allTests, $dir.DIRECTORY_SEPARATOR.$entry, $plugin);
          }
          else {
            $allTests[] = 'Kcatoes'.'\\'.$plugin.'\\'.str_replace('.class.php', '', $entry);
          }
        }
      }
    }
    
    return $allTests;
  }
  
  /**
   * Retourne tous les tests ordonnés par Id
   * @return unknown_type
   */
  public static function getAllTestsById() 
  {
    $allTests = self::getAllTestsFromDir();
    $testsById = array();
    
    foreach($allTests as $test) 
    {
      $testsById[$test::testId] = $test;
    }
    
    // tri
    uksort($testsById, array('TestsHelper', "sortByTestIdFromId"));
    
    return $testsById;
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
	 * Retourne un tableau des catégories de test
	 * @return unknown_type
	 */
	public static function getAllThematiques()
	{
	  $allTests       = self::getAllTestsFromDir();
	  
	  $thematiques_array = array();
	  $thematiques_hash  = array();

	  $hasNull = false;
	  
	  // Parcours des tests
    foreach($allTests as $test)
    {
      $thematique = $test::getGroup('thematique');
      
      if (is_null($thematique))
      {
        $hasNull = true;
      }
      
      if (! isset($thematiques_hash[$thematique]))
      {
        $thematiques_hash[$thematique] = true;
        array_push($thematiques_array, $thematique);
      }
    }
    
    if ($hasNull)
    {
      array_push($thematiques_array, 'autres');
    }
    
    return $thematiques_array;
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
				  self::getRequiredDir($allPluginPath.DIRECTORY_SEPARATOR.$plugin);
				}
			}
		}
	}
	
	private static function getRequiredDir($dir = null){
	  if ($handle = opendir($dir))
	  {
	    while (false !== ($entry = readdir($handle)))
	    {
        if ($entry != '.' && $entry != '..')
        {
          if (is_dir($dir.DIRECTORY_SEPARATOR.$entry))
          {
            // Répertoire -> récursion
            self::getRequiredDir($dir.DIRECTORY_SEPARATOR.$entry);
          }
          else {
            // Inclusion de la classe
            require_once $dir.DIRECTORY_SEPARATOR.$entry;
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

	
  /******************************************************************************************
   * Fonctions de callback pour tri 
   */
	
	
  /**
   * Fonction de callback pour tri des champs par ID de test
   * @param unknown_type $class_a
   * @param unknown_type $class_b
   * @return unknown_type
   */
  public static function sortByTestIdFromClass($class_a, $class_b)
  {
    $id_a = $class_a::testId;
    $id_b = $class_b::testId;

    return self::sortByTestIdFromId($id_a, $id_b);
  }
  
  /**
   * Fonction de callback pour tri par ID de test
   * @param string $a
   * @param string $b
   * @return int
   */
  public static function sortByTestIdFromId($id_a, $id_b)
  {
    $ver_a = explode('.', $id_a);
    $ver_b = explode('.', $id_b);

    $a1 = intval($ver_a[0]);
    $a2 = intval($ver_a[1]);
    
    $b1 = intval($ver_b[0]);
    $b2 = intval($ver_b[1]);
    
    // Comparaison des numéros de version principaux
    if ($a1 < $b1) { return -1; }
    if ($a1 > $b1) { return  1; }
    
    // Comparaison des numéros de sous-version
    if ($a2 > $b2) { return  1; }
    if ($a2 < $b2) { return -1; }
    
    // Egalité
    return 0;
  }
  
  
}