<?php

/**
 * Classe dont devra hériter le code de chaque test automatisable
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
abstract class ASource
{
  // Libellé du test
	const testName = 'Le nom du test n\'est pas défini';
	
	// ID du test
	const testId = 'L\'id du test n\'est pas défini';
	
	// Procédure
	protected static $testProc = array();
	
	// Documents de référence
	protected static $testDocLinks = array();
	
	// Regroupements
	protected static $testGroups = array();
	
	
	// Page testée
	protected $page;
	
	// Résultats du test
	private $results = array();
	
	
	static public function getThematique()
	{
		if (isset(static::$testGroups) && isset(static::$testGroups['thematique']))
		{
			return static::$testGroups['thematique'];
		} else {
			return 'Aucune thématique définie';
		}
	}
	public function __construct(Page $page)
	{
		$this->page = $page;
	}

  /**
   * Retourne le libellé d'un test
   * @param string $classname  Le nom de la classe
   * @return string
   */
  public static function getLibelle(){
    return static::testName;
	}
	
  /**
   * Retourne l'id et le libellé d'un test
   * @param string $classname  Le nom de la classe
   * @return string
   */
  public static function getIdLibelle(){
    return static::testId.' - '.static::testName;
	}
	
	
	/**
	 * Permet d'ajouter une ligne de résultat au test
	 * @param DOMNode $node
	 * @param unknown_type $result
	 * @param unknown_type $comment
	 */
	protected function addResult(DOMNode $node = null, $result, $comment)
	{
		if (is_null($node))
		{
      array_push($this->results, array(
        'node' => null
        ,'xpath' =>  ''
        ,'cssSelector' => ''
        ,'source' => ''
        ,'result' => $result
        ,'comment' => $comment
      ));
		}
		else
		{
			array_push($this->results, array(
			  'node' => $node
			  ,'xpath' =>  $node->getNodePath()
			  ,'cssSelector' => $this->getCssSelector($node)
			  ,'source' => $this->getSourceCode($node)
			  ,'result' => $result
			  ,'comment' => $comment
			));
		}
	}
	
	/**
	 * Permet de récupérer les différentes lignes de résultat
	 */
	public function getTestResults()
	{
		return $this->results;
	}
	
	/**
	 * Permet de récupérer les différents groupes
	 * 
	 * @return array
	 */
	public static function getGroups()
	{
    return static::$testGroups;
	}
	
	/**
	 * Récupère un Groupe
	 * @return mixed
	 */
	public static function getGroup($key)
	{
    if (isset(static::$testGroups[$key])) 
    {
      return static::$testGroups[$key];
    }
    return null;
	}
	
	/**
	 * Permet de récupérer la procédure de test
	 * Si $flat vaut true, alors le tableau est ramené à un
	 * tableau à une dimension
	 *  
	 * @param boolean $flat
	 */
	public static function getProc($flat = false)
	{
		if($flat)
		{
			return self::array_flatten(static::$testProc);
		}
		else
		{
			return static::$testProc;
		}
	}
	
	 /**
   * Permet de récupérer les liens des document
   * Si $flat vaut true, alors le tableau est ramené à un
   * tableau à une dimension
   *  
   * @param boolean $flat
   */
  public static function getDocLinks($flat = false)
  {
  	if($flat)
    {
      return self::array_flatten(static::$testDocLinks);
    }
    else
    {
      return static::$testDocLinks;
    }
  }
	
	/**
	 * Permet de renvoyer un statut global sur le test en se fondant
	 * sur d'éventuels résultats multiple (lorsque le test doit porter
	 * sur plusieurs éléments)
	 * 
	 * @throws KcatoesWrapperException
	 */
	public function getMainResult()
	{
    // si aucun résultat intermédiaire -> NA
    // si un failed -> failed
    // si failed = 0 :
    //     si que des NA: -> NA
    //     si manuel >0 -> manuel
    //     si manuel =0 et passed >0 ->passed
       
		$nbECHEC = 0;
		$nbREUSSITE = 0;
		$nbNA = 0;
		$nbMANUEL = 0;
		
		foreach($this->results as $result)
		{
			switch($result['result'])
			{
				case Resultat::ECHEC:
					$nbECHEC++;
					break;
				case Resultat::REUSSITE:
					$nbREUSSITE++;
				  break;
				case Resultat::NA:
					$nbNA++;
					break;
				case Resultat::MANUEL:
				  $nbMANUEL++;
				  break;
				default:
					throw new KcatoesWrapperException();
			}
		}
		
		if ($nbECHEC > 0)
		{
			return Resultat::ECHEC;
		}
		else
		{
		  if ($nbMANUEL > 0){
		   	return Resultat::MANUEL;
		  }
			if ($nbREUSSITE == 0 && $nbNA > 0)
			{
				return Resultat::NA;
			}
			if ($nbREUSSITE > 0)
			{
				return Resultat::REUSSITE;
			}
		}
		
		// la boucle finissant nécessairement par un return, si on se trouve ici
		// c'est que le test est non applicable (aucun élément n'a été testé)
		return Resultat::NA;
	}
	
	/**
	 * Permet de récupérer des informations de contexte sur le résultat
	 * @param Array $itemName => $itemValue
	 */
	public function getResultContextInfo($result)
	{
		$info = array();
		if (!is_null($result['node']))
		{
			$info['xpath'] = $result['xpath'];
			$info['cssSelector'] = $result['cssSelector'];
			$info['source'] = $result['source'];
			$info['text'] = $result['node']->textContent;
		}
	}
	

  /**
   * Recréée un sélecteur CSS permettant d'accéder au DOMNode passé en paramètre
   *
   * @param DOMNode $node La node dont il faut recrééer le chemin XPath
   *
   * @return Le sélecteur CSS de la node passée en paramètre
   *
   */
  private function getCssSelector(DOMNode $node)
  {
  	$domXpath = new DOMXPath($node->ownerDocument);
  	$cssSelector = '';
  	$first = true;
  	do
  	{
  		$id = false;
			foreach ($node->attributes as $attrName => $attrNode)
			{
				if ($attrName == 'id')
				{
					$id = $attrNode->nodeValue;
				}
			}
  		if ($id)
  		{
  			$cssSelector = '#'.$id.($first?'':' ').$cssSelector;
  		} else {
	  		$position = 1+$domXpath->query('preceding-sibling::*', $node)->length;
  			$cssSelector = $node->nodeName.':nth-child('.$position.')'.($first?'':' ').$cssSelector;
  		}
  		$first = false;
  		$node = $node->parentNode;
  		
  	} while ($node->nodeName != 'html' && !$node instanceof DOMDocument && !$id);
  	
  	return $cssSelector;
  }

  /**
   * Récupère le code source de la DOMNode passée en paramètre
   *
   * @param DOMNode $node La node dont il faut récupérer le code source
   *
   * @return Le code HTML de la node passée en paramètre
   */
  private function getSourceCode(DOMNode $node)
  {
    $temp_doc  = new DOMDocument('1.0', 'UTF-8');
    $temp_doc->formatOutput = true;
    $temp_node = $temp_doc->importNode($node, true);
    $temp_doc->appendChild($temp_node);
    //return $temp_doc->saveHTML();
    return preg_replace('#<\?[^?]*\?>#', '', $temp_doc->saveXML());
  }

  /**
   * Permet d'aplatir un tableau en un tableau à une dimension 
   * @param array $input
   * @return array the flattened array
   */
	private static function array_flatten(array $input) { 
	   if (!is_array($input)) { 
	     return FALSE; 
	   } 
	   $result = array(); 
	   foreach ($input as $key => $value) { 
	     if (is_array($value)) { 
	       $result = array_merge($result, self::array_flatten($value)); 
	     } 
	     else { 
	       $result[$key] = $value; 
	     } 
	   } 
	   return $result; 
	 }
  
  /**
   * Exécute le test implémenté sur une page web
   *
   * @param Page $page La page sur à tester
   */
  abstract public function execute();
}
