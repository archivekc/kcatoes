<?php

/**
 * Gestionnaire de tests de KCatoes
 *
 * @author Adrien Couet
 *
 */
class Tester
{
  private $tests;
  private $page;

  public function __construct($_page, $_tests)
  {
    $this->page = $_page;
    $this->tests = $_tests;
  }

  /**
   * Exécute les tests spécifiés lors de la création du tester
   *
   */
  public function executeTest()
  {
    foreach($this->tests as $test)
    {
      if($test->isAutomatisable())
      {
        if($test->isExecutable())
        {
          try
          {
            $test->execute($page);
          }
          catch(KcatoesTestException $e)
          {
            $test->resultat = new Resultat(Resultat::ERREUR, $e->getMessage());
          }
        }
      }
      else
      {
        $aide = $test->getAide();
        $test->resultat = new Resultat(Resultat::MANUEL, 'Ce test doit être effectué manuellement.');
        $test->resultat->setAide($aide);
      }
    }
  }
}