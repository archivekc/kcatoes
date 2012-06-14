<?php

class SystemHelper
{
  
  /**
   * Lancement d'une tâche symfony dans un processus détaché
   * @param string $taskName Le nom de la tâche
   * @param string $args     Les arguments de la tâche
   * @return mixed
   */
  static public function launchSfTask($taskName, $args=array())
  {
    $symfony  = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'symfony';
    $argStr = '';
    
    foreach($args as $key => $val)
    {
      $argStr .= " $key=$val ";
    }
        
    $command  = "php $symfony $taskName $argStr";
    
    return self::launchProcess($command);
  }
  
  
  /**
   * Lancement d'un processus détaché
   * @param string $command
   * @return mixed
   */
  static public function launchProcess($command)
  {
    // Windows
    if (substr(php_uname(), 0, 7) == "Windows"){
      $WshShell = new COM("WScript.Shell");
      return $oExec = $WshShell->Run('cmd /C '.$command, 0, false);
    }
    
    // unices
    else
    {
      $logFile = sfConfig::get('sf_log_dir').DIRECTORY_SEPARATOR.'exec_'.date('Y-m-d_H:i:s').'.log';
      return exec("$command > $logFile &");
    } 
  }
  
  /**
   * Création d'un fichier de flag (pour communiquer avec la tâche d'exécution des tests)
   */
  static public function createFlagFile($fileName)
  {
    $filePath = sfConfig::get('app_flagfilepath').DIRECTORY_SEPARATOR.$fileName;
    fclose(fopen($filePath, 'a'));
  }

}