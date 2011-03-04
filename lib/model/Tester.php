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
  private $logger;

  /**
   * Créé un testeur à partir d'une page web et d'une liste de tests
   * qui lui seront appliqués
   *
   * @param Page  $_page  Page sur laquelle sont exécutés les tests
   * @param array $_tests Liste des tests à exécuter
   */
  public function __construct(Page $_page, $_tests, sfLogger $_logger = null)
  {
    $this->page = $_page;
    $this->tests = $_tests;
    $this->logger = $_logger;
  }

  /**
   * Exécute les tests spécifiés lors de la création du tester
   *
   */
  public function executeTest()
  {
    foreach($this->tests as $test)
    {
      $this->addLogInfo($test->getNom().' - Lancement de l\'exécution');
      if ($test->isAutomatisable())
      {
        if ($test->isExecutable())
        {
          $test->execute($this->page);
        }
      }
      if ($test->getResultat()->resultatCode != Resultat::ERREUR && $test->getResultat()->resultatCode != Resultat::NON_EXEC)
      {
        $this->addLogInfo($test->getnom().' - '.$test->getResultat());
      }
      else
      {
        $this->addLogErreur($test->getnom().' - '.$test->getResultat());
      }
      echo $test->getNom().': ';
      echo $test->getResultat().'<br />';
    }
  }

  /**
   * Ajoute un message d'erreur au journal de log
   *
   * @param String $errorMessage Message à ajouter
   */
  private function addLogErreur($errorMessage)
  {
    if($this->logger instanceof sfLogger)
    {
      $this->logger->err($errorMessage);
    }
  }

  /**
   * Ajoute un message d'information au journal de log
   *
   * @param String $infoMessage Message à ajouter
   */
  private function addLogInfo($infoMessage)
  {
    if($this->logger instanceof sfLogger)
    {
      $this->logger->info($infoMessage);
    }
  }
}