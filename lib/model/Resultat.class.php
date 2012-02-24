<?php

/**
 * Stocke le résultat d'un test et les informations qui y sont associées
 *
 * @package Kcatoes
 * @author  Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class Resultat
{
  const ECHEC    = 0; //La page n'a pas passé le test
  const REUSSITE = 1; //La page a passé le test
  const MANUEL   = 2; //Le test doit être effectué manuellement
  const NON_EXEC = 3; //Problème lié à la classe du test
                      //(classe non trouvée ou mal implémentée)
  const ERREUR   = 4; //Erreur lors de l'exécution du test
  const NA       = 5; //Lorsque le test n'est pas applicable

  /**
   * Contruit un résultat avec un code de résultat
   * et l'explication associée
   *
   * @param int $_resultatCode Code de résultat (doit correspondre à l'une des
   *                           constantes de la classe)
   */
  public function __construct($_resultatCode)
  {
      throw new KcatoesException('La classe Resultat n\'est pas prévue pour être instanciée');
  }
  
  /**
   * Permet de récupérer le libellé associé aux valeurs des constantes
   * @param int
   * @return string
   */
  static function getLabel($code)
  {
  	switch($code)
  	{
	    case self::ECHEC:
	      return 'Echec';
        break;
	    case self::REUSSITE:
	      return 'Réussite';
	      break;
	    case self::MANUEL:
	      return 'Manuel';
	      break;
	    case self::NON_EXEC:
	      return 'Non exécutable';
	      break;
	    case self::ERREUR:
	      return 'Erreur d\'exécution';
	      break;
	    case self::NA:
        return 'Non applicable';
        break;
	    default:
	      return '';
	      break;
  	}
  }
  /**
   * Permet de récupérer le libellé associé aux valeurs des constantes
   * @param int
   * @return string
   */
  static function getCode($code)
  {
    switch($code)
    {
      case self::ECHEC:
        return 'ECHEC';
        break;
      case self::REUSSITE:
        return 'REUSSITE';
        break;
      case self::MANUEL:
        return 'MANUEL';
        break;
      case self::NON_EXEC:
        return 'NONEXEC';
        break;
      case self::ERREUR:
        return 'ERREUR';
        break;
      case self::NA:
        return 'NA';
        break;
      default:
        return '';
        break;
    }
  }
}