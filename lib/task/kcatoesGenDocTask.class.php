<?php

class kcatoesGenDocTask extends sfBaseTask
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
      // add your own options here
    ));

    $this->namespace        = 'kcatoes';
    $this->name             = 'gen-doc';
    $this->briefDescription = 'Permet de générer des éléments de documentation sur l\'applicatif';
    $this->detailedDescription = <<<EOF

EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $testAutoState = TestsHelper::getTestsAutoState();
  
    $buffer = fopen('php://temp', 'r+');
    fputcsv($buffer, TestsHelper::getTestInfoHeader(), ';');
    for ($i=0, $l=count($testAutoState); $i<$l; $i++)
    {
			fputcsv($buffer, $testAutoState[$i], ';');
    }
		rewind($buffer);
		$csv = stream_get_contents($buffer);
		fclose($buffer);
		$csv = mb_convert_encoding( $csv, 'UTF-16LE', 'UTF-8');
		file_put_contents(sfConfig::get('app_gendocpath').DIRECTORY_SEPARATOR.'auto_state.csv', $csv);
//   TestsHelper::getTestsAutoState();
  }
}
