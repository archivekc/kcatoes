<?php

/**
 * Stocke le résultat d'un test et les informations qui y sont associées
 *
 * @author Adrien Couet
 *
 */
class Resultat
{
  const ECHEC     = 0; //La page n'a pas passé le test
  const REUSSITE  = 1; //La page a passé le test
  const MANUEL    = 2; //Le test doit être effectué manuellement
  const NON_EXEC  = 3; //Problème lié à la classe du test (classe non trouvée ou mal implémentée)
  const ERREUR    = 4; //Erreur lors de l'exécution du test

  private $resultatCode;
  private $explication = '';
  private $aide = '';

  public function __construct($_resultatCode, $_explication)
  {
    $this->resultatCode = $_resultatCode;
    $this->explication = $_explication;
  }

  public function setAide($_aide)
  {
    $this->aide = $_aide;
  }

  public function __get($var)
  {
    return $this->$var;
  }
}