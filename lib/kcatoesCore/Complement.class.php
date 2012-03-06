<?php

/**
 * Regroupe les informations relatives à un élément de la page ayant échoué
 * à passer un test ou nécessitant une vérification manuelle
 *
 * @package Kcatoes
 * @author  Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class Complement
{
  private $code;
  private $xPath;
  private $explication;

  /**
   * Construit un echec à partir des informations passées en paramètre
   *
   * @param String $_code        Code source de l'élément
   * @param String $_xPath       Chemin XPath de l'élément dans la page
   * @param String $_explication Message d'explication
   */
  public function __construct($_code, $_xPath, $_explication)
  {
    $this->code        = $_code;
    $this->xPath       = $_xPath;
    $this->explication = $_explication;
  }

  /**
   * Fonction d'accès aux paramètres de la classe
   *
   * @param String $var Le nom de la variable à récupérer
   *
   * @return La valeur de la variable
   */
  public function __get($var)
  {
    return $this->$var;
  }
}