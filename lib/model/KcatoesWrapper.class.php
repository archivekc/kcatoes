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
   *
   * @throws KcatoesWrapperException
   */
  public function __construct($testsIds, $htmlContent = null, $url = null)
  {
    $this->logger = sfContext::getInstance()->getLogger();

    $this->addLogInfo('Initialisation de KCatoès');

    if (!is_array($testsIds))
    {
      $testsIds = array($testsIds);
    }

    if (empty($testsIds))
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

    $page = new Page($content, $this->logger);

    try
    {
      $page->buildCrawler();
    }
    catch (KcatoesCrawlerException $e)
    {
      $this->addLogErreur($e->getMessage());
      throw new KcatoesWrapperException($e->getMessage());
    }

    $this->tester = new Tester($page, $testsIds, $this->logger);

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

    try
    {
      $csv = $this->tester->toCSV();
    }
    catch (KcatoesWrapperException $e)
    {
      $this->addLogErreur($e->getMessage());
      throw new KcatoesWrapperException($e->getMessage());
    }

    $this->addLogInfo('Exécution de KCatoès réussie');

    return $csv;
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

  /**
   * Ajoute un message d'information au journal de log
   *
   * @param String $infoMessage Message à ajouter
   */
  private function addLogInfo($infoMessage)
  {
    if ($this->logger instanceof sfLogger)
    {
      $this->logger->info($infoMessage);
    }
  }

  /**
   * Ajoute un message d'erreur au journal de log
   *
   * @param String $errorMessage Message à ajouter
   */
  private function addLogErreur($errorMessage)
  {
    if ($this->logger instanceof sfLogger)
    {
      $this->logger->err($errorMessage);
    }
  }
}