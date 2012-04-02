<?php

/**
 * Wrapper du framework KCatoès. Sert d'interface entre le framework et les
 * outils l'utilisant.
 *
 * @package Kcatoes
 * @author  Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class KcatoesWrapper
{

  private $logger;
  private $tester;
  private $rawcontent;
  private $executed = false;

  /**
   * Initialise les différents composants du framework.
   * Les identifiants passés en paramètre doivent correspondre à ceux en base
   * de données des tests sélectionnés.
   * L'URL et le code source HTML sont deux moyens de fournir au framework le
   * contenu qu'il devra tester. Au moins l'un des deux doit être initialisé. Si
   * les deux le sont, seul le code source HTML sera pris en compte.
   *
   * @param array  $testsIds    Liste des identifiants des tests à exécuter
   * @param string $htmlContent Code source HTML à tester
   * @param string $url         URL d'une page à tester
   * @param string $mode        'action' | 'task'
   * 
   * @throws KcatoesWrapperException
   */
  public function __construct($testsClass, $htmlContent = null, $url = null, $mode='action')
  {
  	$this->mode = $mode;
  	switch ($this->mode) {
  		case 'action' : 
        $this->logger = sfContext::getInstance()->getLogger();
  			break;
  			
  		case 'task' : 
        $this->logger = new sfNoLogger(new sfEventDispatcher());
  			break;
  	}
    
    $this->addLogInfo('Initialisation de KCatoès');

    if (!is_array($testsClass))
    {
      $testsClass = array($testsClass);
    }

    if (empty($testsClass))
    {
      $erreur = 'Aucun test n\'a été sélectionné';
      $this->addLogErreur($erreur);
      throw new KcatoesWrapperException($erreur);
    }

    if (!empty($htmlContent))
    {
      $content = $htmlContent;
    }
    else if (!empty($url))
    {
      try
      {
        $content = $this->extractUrlContent($url);
      }
      catch (KcatoesUrlReadException $e)
      {
        $this->addLogErreur($e->getMessage());
        throw new KcatoesWrapperException($e->getMessage());
      }
      catch(RuntimeException $e)
      {
        $this->addLogErreur($e->getMessage());
        throw new KcatoesWrapperException($e->getMessage());
      }
    }
    else
    {
      $erreur = 'Le contenu HTML et l\'URL sont vides ou non initialisés';
      $this->addLogErreur($erreur);
      throw new KcatoesWrapperException($erreur);
    }

    $page = new Page($content, $this->logger, $url);
    $this->rawcontent = $content;

    try
    {
      $page->buildCrawler();
    }
    catch (KcatoesCrawlerException $e)
    {
      $this->addLogErreur($e->getMessage());
      throw new KcatoesWrapperException($e->getMessage());
    }

    $this->tester = new Tester($page, $testsClass, $this->logger);

    $this->addLogInfo('Initialisation de KCatoès réussie');
  }

  /**
   * Lance l'exécution des tests sélectionnés sur le contenu spécifié lors de
   * l'initialisation
   *
   * @throws KcatoesWrapperException
   *
   * @return string Le chemin d'accès au CSV contenant le résultat des tests
   */
  public function run()
  {
    $this->addLogInfo('Exécution de KCatoès');

    try
    {
      $this->tester->executeTest();
    }
    catch (KcatoesTesterException $e)
    {
      $this->addLogErreur($e->getMessage());
      throw new KcatoesWrapperException($e->getMessage());
    }
    $this->addLogInfo('Exécution de KCatoès réussie');
    $this->executed = true;
  }
  
  public function getRawContent($baseUrl=null)
  {
  	if (is_null($baseUrl))
  	{
	  	return $this->rawcontent;
  	}
  	else
  	{
  	 return preg_replace('#(<head[^>]*>)#i', "$1".'<base href="'.$baseUrl.'">', $this->rawcontent);
  	}
  }
  
  /**
   * Indique le chemin où stocker le résultat (sortie HTML riche)
   * @return unknown_type
   */
  public static function getExportPath($type='absolute', $sep='fs', $page=null, $testConfig=null){
  	
  	// Type de séparateur
    switch ($sep) {
    	case 'fs':  $DS = DIRECTORY_SEPARATOR; break;
    	case 'web': $DS = '/';                 break;
    }
    
    // Chemin relatif ou absolu
  	switch ($type) {
  		case 'absolute': $exportPath = sfConfig::get('app_outputpath').$DS; break;
  		case 'relative': $exportPath = '';                                  break;
  	}

		$exportPath .= $page->getId().'-'.$testConfig->getId().$DS;

    return $exportPath; 
  }

  
  /**
   * Génération de la sortie
   * 
   * @param string $type
   * @param boolean $history
   * @param array $fields
   * @return string
   */
  public function output($type = 'csv', $history = false, &$fields = array())
  {
    $this->addLogInfo('Génération de la sortie');
    
  	switch (strtolower($type))
  	{
  		case 'csv':  $outputStr = $this->tester->toCSV();                       break;
  		case 'json': $outputStr = $this->tester->toJSON();                      break;
      case 'html': $outputStr = $this->tester->toHTML();                      break;
      case 'rich': $outputStr = $this->tester->toRichHTML($history, $fields); break;
  		default:     throw new KcatoesException();
  	}
  	return $outputStr;
  }

  /**
   * Extrait le contenu d'un site web sous forme de string après avoir vérifié
   * la validité de son URL
   *
   * @param string $url L'url de la page
   *
   * @throws KcatoesUrlReadException
   *
   * @return string $content Le contenu de la page
   */
  private function extractUrlContent($url)
  {
    try
    {
      KcatoesUrlValidator::isValide($url);
    }
    catch(KcatoesUrlException $e)
    {
      $errorMessage = 'L\'URL indiquée n\'est pas valide: '.$e->getMessage();
      throw new KcatoesUrlReadException($errorMessage);
    }
    $content = file_get_contents($url);
    if ($content === false)
    {
      throw new KcatoesUrlReadException('Erreur lors de la lecture du contenu de l\'url');
    }
    return $content;
  } 
  
  /*************************************************************************************************
   * 
   */
  
  /**
   * Fonction commune permettant :
   *    - d'instancier le wrapper 
   *    - d'exécuter les tests
   *    - d'exporter les résultats
   * 
   * @param array $classList Liste des classes de test à lancer
   * @param array $options  Tableau d'options : 
   *                          string  'html'    Contenu HTML à tester, 
   *                          string  'url'     URL à tester
   *                          string  'output'  
   *                          boolean 'history' Indique si on active l'historisation
   * @param string $mode = 'action' | 'task'
   * 
   * @return KcatoesWrapper L'instance de KcatoesWrapper créée
   */
  public static function execute($classList, $options=array(), $mode='action', $page=null, $testConfig=null){
  	
    // Instanciation du wrapper    
    $kcatoes = new KcatoesWrapper($classList, $options['html'], $options['url'], $mode);
    
    // Lance les tests
    $results = $kcatoes->run();
    
    // Exploitation des résultats
    $fields = array();
    $output = $kcatoes->output($options['output'], $options['history'], $fields);

    // TODO : déporter ?
    $tplPath = sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'kcatoesOutput'.DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR;

    switch($options['output'])
    {
      // ***** Export HTML simple *****
      case 'html': 
      	$tpl = file_get_contents($tplPath.'simple.html');
      	$outputmode = 'stdout';    
      	break;
      
      // ***** Export HTML riche *****
      case 'rich': 
      	$tpl = file_get_contents($tplPath.'rich.html');      
      	$outputmode = 'file';    
      	break;
      
      // ***** Par défaut : sortie standard *****
      default:     
      	$outputmode = 'stdout';    
      	break;
    }
      	
    // Génération du rapport HTML
    if (isset($tpl)){
			$rapport = TestsHelper::generateRapportHtml(array(
				'table'     => $output,
			  'score'     => $kcatoes->getScore()*100,
				'title'     => 'KCatoès - Rapport de test',
				'subtitle'  => ($options['url'] ? $options['url'] : '').' '.date('d/m/Y H:i')), 
				$tpl);
    }
    else {
    	$rapport = $output;
    }

    // Sortie
    switch($outputmode){
    	
    	case 'stdout': 
    		echo $rapport;
    		break;
    		
    	case 'file':
    		
    		// Identificaiton du chemin 
    		$exportPath = self::getExportPath('absolute', 'fs', $page, $testConfig);
    		
    		// Création du répertoire de destination
        exec('mkdir '    .$exportPath);
        exec('chmod 777 '.$exportPath);
        
        // Ecriture des rapports
        file_put_contents($exportPath.'output.html', $rapport);
        file_put_contents($exportPath.'tested.html', $kcatoes->getRawContent($options['url']));
        
        // Recopie des fichiers statiques
        TestsHelper::rcopy($tplPath.'img' , $exportPath.'img');
        TestsHelper::rcopy($tplPath.'css' , $exportPath.'css');
        TestsHelper::rcopy($tplPath.'js' , $exportPath.'js');

        // Sortie historisée (possibilité de mettre des commentaires)
        if($options['history'])
        {
          $tplHistorize = file_get_contents($tplPath.'/php/historize.php');
          file_put_contents($exportPath.'/historize.php', TestsHelper::generateHistorize($fields, $tplHistorize));
        }
        
    		$kcatoes->addLogInfo('Sortie générée : ' . $exportPath);
    		break;
    }
    
    return $kcatoes;
  }
  
  
  public function getScore()
  {
  	if ($this->executed)
  	{
  		$nbEchec = 0;
  		$nbReussite = 0;
  		foreach ($this->tester->getResTests() as $test)
  		{
        switch($test->getMainResult())
        {
        	case Resultat::ECHEC:
        		 $nbEchec++;
        	   break;
        	case Resultat::REUSSITE:
        		$nbReussite++;
        		break;
        }
  		}
  		if ($nbEchec + $nbReussite == 0)
  		{
  			return 'N/A';
  		}
  		return $nbReussite / ($nbEchec + $nbReussite);
  	}
  	else
  	{
  		throw new KcatoesException('Les test n\'ont pas été exécutés');
  	}
  }
  
  /**
   * Retourne le résultat des tests
   * @return array
   */
  public function getResTests()
  {
    return $this->tester->getResTests();
  }
  
  
  /**
   * Charge un fichier de configuration au format YAML indiquant la liste des tests à passer 
   * @param string $file
   * @return array
   */
  public static function loadConf($file) {
    $conf_tab = array();
    
    if (file_exists($file)) {
      $conf_tab = sfYaml::load(file_get_contents($file));
    }

    // TODO : supprimer les tests inexistants ? ici ou ailleurs
    return $conf_tab;
  }
  
  /*************************************************************************************************
   * Fonctions de log
   */
  
  /**
   * Ajoute un message d'information au journal de log
   *
   * @param String $infoMessage Message à ajouter
   */
  protected function addLogInfo($infoMessage)
  {
    if ($this->logger instanceof sfLogger)
    {
      $this->logger->info($infoMessage);
    }
    if ($this->mode == 'task') {
      echo 'INFO: '.$infoMessage."\n";
    }
  }

  /**
   * Ajoute un message d'erreur au journal de log
   *
   * @param String $errorMessage Message à ajouter
   */
  protected function addLogErreur($errorMessage)
  {
    if ($this->logger instanceof sfLogger)
    {
      $this->logger->err($errorMessage);
    }
    if ($this->mode == 'task') {
      echo 'ERROR: '.$errorMessage."\n";
    }
  }
  
}