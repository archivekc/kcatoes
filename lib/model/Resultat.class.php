<?php

/**
 * Stocke le résultat d'un test et les informations qui y sont associées
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class Resultat
{
  const ECHEC    = 0; //La page n'a pas passé le test
  const REUSSITE = 1; //La page a passé le test
  const MANUEL   = 2; //Le test doit être effectué manuellement
  const NON_EXEC = 3; //Problème lié à la classe du test (classe non trouvée ou mal implémentée)
  const ERREUR   = 4; //Erreur lors de l'exécution du test

  private $resultatCode;
  private $explicationErreur = '';
  private $instruction = '';
  private $echecs = array();

  /**
   * Contructuit un résultat avec un code de résultat
   * et l'explication associée
   *
   * @param int    $_resultatCode Code de résultat (doit correspondre à l'une des constantes de la classe)
   * @param String $_explication  Explication du résultat
   */
  public function __construct($_resultatCode)
  {
    $this->resultatCode = $_resultatCode;
  }

  /**
   * Permet d'ajouter des instructions pour l'exécution manuelle
   * du test auquel est associé le résultat
   *
   * @param String $_instruction Instructions pour l'exécution manuelle
   */
  public function setInstruction($_instruction)
  {
    $this->instruction = $_instruction;
  }

  public function setExplicationErreur($_explicationErreur)
  {
    $this->explicationErreur = $_explicationErreur;
  }

  public function setEchecs($_echecs)
  {
    $this->echecs = $_echecs;
  }

  /**
   * Fonction d'accès aux paramètres de la classe
   *
   * @param  String $var Le nom de la variable à récupérer
   * @return La valeur de la variable
   */
  public function __get($var)
  {
    return $this->$var;
  }

  /**
   * Retourne le nom du résultat associé à $resultatCode
   *
   */
  public function getCode($withExplication = false)
  {
    $code = '';

    switch ($this->resultatCode)
    {
      case self::ECHEC:
        $code = 'Echec';
        break;
      case self::REUSSITE:
        $code = 'Réussite';
        break;
      case self::MANUEL:
        $code = 'Exécution manuelle';
        break;
      case self::NON_EXEC:
        $code = $withExplication ? 'Non exécutable: '.$this->explicationErreur : 'Non exécutable';
        break;
      case self::ERREUR:
        $code = $withExplication ? 'Erreur d\'exécution: '.$this->explicationErreur : 'Erreur d\'exécution';
        break;
      default:
         $code = '';
         break;
    }

    return $code;
  }

}