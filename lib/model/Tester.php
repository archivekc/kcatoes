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

  /**
   * Créé un testeur à partir d'une page web et d'une liste de tests
   * qui lui seront appliqués
   *
   * @param Page  $_page  Page sur laquelle sont exécutés les tests
   * @param array $_tests Liste des tests à exécuter
   */
  public function __construct(Page $_page, $_tests)
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
      if ($test->isAutomatisable())
      {
        if ($test->isExecutable())
        {
          try
          {
            $test->execute($this->page);
          }
          catch (KcatoesTestException $e)
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