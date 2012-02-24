<?php

/**
 * Classe dont devra hériter le code de chaque test automatisable
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
use Symfony\Component\DomCrawler\Crawler;
abstract class ASource
{
	const testName = 'Le nom du test n\'est pas défini';
	const testId = 'L\'id du test n\'est pas défini';
	const testProc = '';
	
	private $results = array();
//  protected $complements = array();

	protected function addResult(DOMNode $node = null, $result, $comment)
	{
		if (is_null($node))
		{
      array_push($this->results, array(
        'xpath' =>  ''
        ,'source' => ''
        ,'result' => $result
        ,'comment' => $comment
      ));
		}
		else
		{
			array_push($this->results, array(
			  'xpath' =>  $this->getXPath($node)
			  ,'source' => $this->getSourceCode($node)
			  ,'result' => $result
			  ,'comment' => $comment
			));
		}
	}
	
	public function getTestResults()
	{
		return $this->results;
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
		}
		// la boucle finissant nécessairement par un return, si on se trouve ici
		// c'est que le test est non applicable (aucun élément n'a été testé)
		return Resultat::NA;
	}
	

  /**
   * Recréée le chemin XPath permettant d'accéder au DOMNode passé en paramètre
   *
   * @param DOMNode $node La node dont il faut recrééer le chemin XPath
   *
   * @return Le chemin XPath de la node passée en paramètre
   *
   */
  private  function getXPath(DOMNode $node)
  {
  	return $node->getNodePath();
    $domXpath = new DOMXPath($node->ownerDocument);
    $xpath    = '';

    do
    {
      $position = 1 + $domXpath->query('preceding-sibling::*[name()="' . $node->nodeName . '"]', $node)->length;
      $xpath    = '/' . $node->nodeName . '[position()=' . $position . ']' . $xpath;
      $node     = $node->parentNode;
    } while (!$node instanceof DOMDocument);

    return $xpath;
  }

  /**
   * Récupère le code source de la DOMNode passée en paramètre
   *
   * @param DOMNode $node La node dont il faut récupérer le code source
   *
   * @return Le code HTML de la node passée en paramètre
   */
  protected function getSourceCode(DOMNode $node)
  {
    $temp_doc  = new DOMDocument('1.0', 'UTF-8');
    //$temp_doc->formatOutput = true;
    $temp_node = $temp_doc->importNode($node, true);
    $temp_doc->appendChild($temp_node);
    return $temp_doc->saveHTML();
    return preg_replace('#<\?[^?]*\?>#', '', $temp_doc->saveXML());
  }

  /**
   * Exécute le test implémenté sur une page web
   *
   * @param Page $page La page sur à tester
   */
  abstract public function execute(Page $page);
}
