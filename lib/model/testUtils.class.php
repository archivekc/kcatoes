<?php

class testUtils
{
	public function __construct()
	{
		throw new KcatoesException('La classe testUtils n\'est pas prévue pour être instanciée');
	}
	
	static public function getLibelle($classname)
	{
		if (class_exists($classname, false))
		{
			return $classname::testName;
		}
		return false;
	}
	
	static function getAllTests()
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
              $allTests[] = 'Kcatoes\\'.$entryPlugin.'\\'.str_replace('.class.php', '', $entry);
              }
            }
          }
        }
      }
    }
    return $allTests;
	}
	
	/**
	 * Permet le chargement des classes de test
	 * @param $allPluginPath
	 */
	static function getRequired()
  {
    $allPluginPath = sfConfig::get('app_pluginpath');
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
}