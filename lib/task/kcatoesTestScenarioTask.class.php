<?php

class kcatoesTestScenarioTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'Le nom de l\'application', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'L\'environnement (dev|prod|..)', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'Le type de connexion (doctrine|propel)', 'doctrine'),
      
      new sfCommandOption('scenario', 's', sfCommandOption::PARAMETER_REQUIRED, 'L\'id du scénario'),
      new sfCommandOption('extracts', 'e', sfCommandOption::PARAMETER_OPTIONAL, 'Les identifiants des extractions pour lesquelles lancer les tests (séparés par des virgules)'),
    ));

    $this->namespace        = 'kcatoes';
    $this->name             = 'test-scenario';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
La tâche [kcatoes:testScenario|INFO] permet de lancer les tests sur un scénario donné.

EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
   
    // *****
    
    // Récupération du scénario
    if ($options['scenario'] === null)
    {
      throw new sfException('Le paramètre scenario est obligatoire.');
    }
    if (strcmp($options['scenario'] + 0, $options['scenario']) != 0)
    {
      throw new sfException('Le paramètre scenario est invalide.');     
    }
    
    $scenario = ScenarioTable::getInstance()->find($options['scenario']);
      
    if (! $scenario instanceof Scenario)
    {
      throw new sfException('Le scénario n\'existe pas.');
    }
    
    // Vérification de la présence du répertoire de fichiers flags
    $dir = sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'runningTests';
    if (! is_dir($dir))
    {
      mkdir($dir);
    }
    
    // Chemin du fichier de flag (indiquant l'exécution et la progression des tests en cours)
    $this->flagFile = $dir . DIRECTORY_SEPARATOR . 'execution_scenario_' . $options['scenario'];
    
    
    // Verrou
    $fp = fopen($this->flagFile.'_lock', "c");
    if(!flock($fp, LOCK_EX | LOCK_NB)) {
      throw new sfException('La tâche est déjà en cours d\'exécution pour ce scénario');
      exit(-1);
    }


    // *****
    
    // *** Récupération des extractions
    $extractIds = ($options['extracts']) ? explode(',', $options['extracts']) : null;
    $extracts = WebPageExtractTable::getInstance()->searchByScenarioId($options['scenario'], $extractIds);
    $extractionsTotal = count($extracts);
    
    // *** Récupération de tous les tests
    $allTests = TestsHelper::getAllTestsFromDir();
    $testsTotal = count($allTests);
    
    $this->total = $testsTotal * $extractionsTotal;

    
    // *** Exécution des tests
    
    $this->currentIndex = 0;
    $this->writeFlag();
    
    while($this->currentIndex < $this->total)
    {
      // Mise à jour des index
      $extractionIndex = floor($this->currentIndex / $testsTotal);
      $testsIndex      = $this->currentIndex % $testsTotal;
      
      // Instanciation du wrapper
      $extract = $extracts[$extractionIndex];
      $test    = $allTests[$testsIndex];
      
      $kcatoes = new KcatoesWrapper(array($test), $extract->getSrc(), null, 'task', true);

      // Suppression des résultats précédents
      // TODO : historisation
      if ($testsIndex == 0)
      {
        $resPrec = $extract->getCollectionResults();
        $resPrec->delete();
      }
      
      // Lancement du prochain test
      // TODO : à faire dans un try{} (il faut impérativement capturer toutes les erreurs pour retourner toujours la sortie en JSON)
      // TODO : factoriser (intégrer à quelque chose dans /lib/, KCatoesWrapper ou autre)
      $results  = $kcatoes->run();
      $this->resTests = $kcatoes->getResTests();

      // Sauvegarde en base
      foreach($this->resTests as $resTest)
      {
        // Nouvel enregistrement pour le résultat global
        $result = new TestResult();
        $result->saveResult($extract, $resTest);
      }

      // nettoyage
      unset($kcatoes);
      
      // Incrémentation
      $this->currentIndex++;
      $this->writeFlag();
      
      echo '.';
      if ($this->currentIndex % 10 == 0)
      {
        echo "\n";
      }
      
    } // fin parcours des tests à exécuter
    
    
    $this->deleteFlag();
    echo "\n";
    
    // Libère le verrou
    flock($fp, LOCK_UN);
    fclose($fp);
    unlink($this->flagFile.'_lock');
    
  }
  
  /**
   * Ecriture du fichier de flag
   */
  protected function writeFlag()
  {
    $f = fopen($this->flagFile, 'wb');
    fwrite($f, $this->currentIndex.'/'.$this->total);
    fclose($f);
  }
  
  
  /**
   * Supprime le fichier de flag 
   */
  protected function deleteFlag()
  {
    unlink($this->flagFile);
  }
  
}
