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
      // see: http://de2.php.net/manual/en/function.exec.php#35731
      
      $WshShell = new COM("WScript.Shell");
      return $oExec = $WshShell->Run('cmd /C '.$command, 0, false);
      
      //pclose(popen('start "tests" "' . $command . '"', "r")); 
    }
    
    // unices
    else
    {
      return exec($scriptPath . " " . $args . ' >'.$outPath.'&');   
    } 
  }
  
}