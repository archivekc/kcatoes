<?php

/**
 * Gestionnaire de tests de KCatoes
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
use Zend\Validator\File\Count;
class Tester
{
  private $tests;
  private $page;
  private $logger;
  private $toExecute;

  /**
   * Créé un testeur à partir d'une page web et d'une liste de tests
   * qui lui seront appliqués
   *
   * @param Page  $_page  Page sur laquelle sont exécutés les tests
   * @param array $_tests Liste des tests à exécuter
   */
  public function __construct(Page $_page, $_tests, sfLogger $_logger = null)
  {
    $this->page      = $_page;
    $this->tests     = $_tests;
    $this->logger    = $_logger;
    $this->toExecute = array();
  }

  /**
   * Exécute les tests spécifiés lors de la création du tester
   *
   */
  public function executeTest()
  {
    foreach($this->toExecute as $index => $test)
    {
      $execute = true;
      $explication = '';
      if ($test->getDependanceId() != null)
      {
        $dependanceResult = $this->toExecute[$index-1]->getResultat()->resultatCode;
        if ($dependanceResult === Resultat:: NON_EXEC)
        {
          $execute = false;
          $explication = $test->getNom().' - Non exécutable: la dépendance '.
                                        'directe du test n\'a pas été exécutée';
        }
        elseif ($dependanceResult != $test->getExecuteSi())
        {
          $execute = false;
          $explication = $test->getnom().' - Non exécutable: le résultat de sa '.
                        'dépendance directe ne permet pas l\'exécution du test';
        }
      }
      if ($execute)
      {
        $this->addLogInfo($test->getNom().' - Lancement de l\'exécution');
        if ($test->isExecutable())
        {
          $test->execute($this->page);
        }
      }
      else
      {
        $resultat = new Resultat(Resultat::NON_EXEC);
        $resultat->setExplicationErreur($explication);
        $test->setResultat($resultat);
      }
      if ($test->getResultat()->resultatCode != Resultat::ERREUR
          && $test->getResultat()->resultatCode != Resultat::NON_EXEC)
      {
        $this->addLogInfo($test->getnom().' - '.$test->getResultat()->getCode(true));
      }
      else
      {
        $this->addLogErreur($test->getnom().' - '.$test->getResultat()->getCode(true));
      }
    }
  }

  /**
   * Créée la liste des tests qui seront exécutés par l'application en se basant
   * sur les règles de dépendance des tests sélectionnés
   *
   * @throws KcatoesTesterException
   */
  public function createExecutionList()
  {
    $this->addLogInfo('Création de la liste des tests à exécuter');
    try
    {
      foreach ($this->tests as $test)
      {
        $this->toExecute += $test->getExecutionList();
        $this->toExecute[] = $test;
      }
    }
    catch (Exception $e)
    {
      $this->addLogErreur('Erreur lors de la création de la liste des tests à exécuter');
      throw new KcatoesTesterException($e->getMessage());
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

  /**
   * Exporte le résultat des tests au format CSV
   *
   */
  public function toCSV()
  {
    date_default_timezone_set('Europe/Paris');
    $fileName = 'csv\\test_'.date('dmY_Hi').'.csv';

    $header = array();
    $header['id']          = 'Id';
    $header['nom']         = 'Nom';
    $header['description'] = 'Description';
    $header['resultat']    = 'Résultat';
    $header['erreurExp']   = 'Explication de l\'erreur';
    $header['aide']        = 'Aide à l\'exécution manuelle';
    $header['source']      = 'Code source de l\'élément en échec';
    $header['xpath']       = 'XPath de de l\'élément en échec';
    $header['echecExp']    = 'Explication de l\'élément en échec';

    $csv = @fopen($fileName, "w");
    if (!$csv)
    {
      throw new KcatoesTecException('Impossible d\'écrire dans un fichier CSV');
    }
    fputcsv($csv, $header, ';', '"');

    foreach ($this->tests as $test)
    {
      $line = array();
      $line['id']          = $test->getId();
      $line['nom']         = $test->getNom();
      $line['description'] = trim($test->getDescription());
      $line['resultat']    = $test->getResultat()->getCode();
      $line['erreurExp']   = trim($test->getResultat()->explicationErreur);
      $line['aide']        = trim($test->getResultat()->instruction);
      $line['source']      = 'n.a.';
      $line['xpath']       = 'n.a.';
      $line['echecExp']    = 'n.a.';

      $complements = $test->getResultat()->complements;
      if (empty($complements))
      {
        fputcsv($csv, $line, ';', '"');
      }
      else
      {
        foreach ($complements as $complement)
        {
          $line['source']   = preg_replace('/(\r\n|\n|\r)/', '', $complement->code);
          $line['xpath']    = preg_replace('/(\r\n|\n|\r)/', '', $complement->xPath);
          $line['echecExp'] = preg_replace('/(\r\n|\n|\r)/', '', $complement->explication);

          fputcsv($csv, $line, ';', '"');
        }
      }
    }

    fclose($csv);
    return $fileName;
  }

}