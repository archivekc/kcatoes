<?php

use Zend\Validator\File\Count;


/**
 * test actions.
 *
 * @package    Kcatoes
 * @subpackage test
 * @author     Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class testActions extends sfActions
{
  /**
   * Contrôleur de la page de saise de l'URL
   *
   * @param sfWebRequest $request
   */
  public function executeUrl(sfWebRequest $request)
  {
    $this->form = new UrlForm();
    if ($request->isMethod('post'))
    {
      $this->addLogInfo('Lancement de la validation de l\'URL');
      if ($this->processForm($request, $this->form))
      {
        $formContent = $request->getParameter($this->form->getName());
        $this->getUser()->setAttribute('url', $formContent['url'], 'wizard');
        $this->redirect('test/thematique');
      }
    }
  }

  /**
   * Contrôleur de la page de sélection des thématiques principales
   *
   * @param sfWebRequest $request
   */
  public function executeThematique(sfWebRequest $request)
  {
    $this->form = new SelectThematiqueForm();
    $recommencer = $request->getParameter('recommencer');
    if ($recommencer)
    {
      $this->getUser()->getAttributeHolder()->removeNamespace('wizard');
    }

    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->form))
      {
        $formContent = $request->getParameter($this->form->getName());
        $this->getUser()->setAttribute('thematique', $formContent['thematique'], 'wizard');
        $this->redirect('test/referentiel');
      }
    }
  }

  /**
   * Contrôleur de la page de sélection des référentiels
   *
   * @param sfWebRequest $request
   */
  public function executeReferentiel(sfWebRequest $request)
  {
    $thematiques = $this->getUser()->getAttribute('thematique', null, 'wizard');
    $this->form = new SelectReferentielForm(null, array('thematiques' => $thematiques));
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->form))
      {
        $formContent = $request->getParameter($this->form->getName());
        $this->getUser()->setAttribute('referentiel', $formContent['referentiel'], 'wizard');
        $this->redirect('test/regroupement');
      }
    }
  }

  /**
   * Contrôleur de la page de sélection des regroupements
   *
   * @param sfWebRequest $request
   */
  public function executeRegroupement(sfWebRequest $request)
  {
    $referentiels = $this->getUser()->getAttribute('referentiel', null, 'wizard');
    $this->form = new SelectRegroupementForm(null, array('referentiel' => $referentiels));
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->form))
      {
        $formContent = $request->getParameter($this->form->getName());
        $this->getUser()->setAttribute('regroupement', $formContent['regroupement'], 'wizard');
        $this->redirect('test/test');
      }
    }
  }

  /**
   * Contrôleur de la page de sélection des tests
   *
   * @param sfWebRequest $request
   */
  public function executeTest(sfWebRequest $request)
  {
    $regroupements = $this->getUser()->getAttribute('regroupement', null, 'wizard');
    $this->form = new SelectTestForm(null, array('regroupement' => $regroupements));
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->form))
      {
        $formContent = $request->getParameter($this->form->getName());
        $this->getUser()->setAttribute('test', $formContent['test'], 'wizard');
        $this->redirect('test/confirmation');
      }
    }
  }

  /**
   * Contrôleur de la page de confirmation des choix
   *
   * @param sfWebRequest $request
   */
  public function executeConfirmation(sfWebRequest $request)
  {
    $testsId = $this->getUser()->getAttribute('test', null, 'wizard');
    $url = $this->getUser()->getAttribute('url', null, 'wizard');
    $valide = $request->getParameter('valide');
    if ($valide)
    {
      $this->getUser()->getAttributeHolder()->removeNamespace('wizard');
      $this->getUser()->setAttribute('selectedTests', $testsId);
      $this->getUser()->setAttribute('url', $url);
      $this->redirect('test/execute');
    }
    else
    {
      $this->selectedTests = array();
      $tableTest = Doctrine_Core::getTable('test');

      foreach ($testsId as $testId)
      {
        $test = $tableTest->findOneById($testId);
        $this->selectedTests[] = (string)$test;
      }
      sort($this->selectedTests);
      $this->testCount = count($this->selectedTests);
    }
  }

  /**
   * Contrôleur du coeur de l'application
   *
   * @param sfWebRequest $request
   */
  public function executeExecute(sfWebRequest $request)
  {
    $this->url = $this->getUser()->getAttribute('url');

    $listeIds = $this->getUser()->getAttribute('selectedTests');
    $this->tests = Doctrine::getTable('Test')->getCollectionFromIds($listeIds);

    try
    {
      $content = $this->extractUrlContent($this->url);
    }
    catch (KcatoesUrlReadException $e)
    {
      $this->erreur = $e->getMessage();
      $this->addLogErreur($this->erreur);
      $this->info = 'Une erreur est survenue lors de la récupération du contenu de la page.';
      $this->cheminFichierCsv = '';
      return sfView::SUCCESS;
    }
    catch(Zend\Http\Client\Exception\RuntimeException $e)
    {
      $this->erreur = $e->getMessage();
      $this->info = 'La page ne semble pas accessible.';
      $this->cheminFichierCsv = '';
      return sfView::SUCCESS;
    }

    $page = new Page($content, $this->url, sfContext::getInstance()->getLogger());
    try
    {
      $page->buildCrawler();
    }
    catch (KcatoesCrawlerException $e)
    {
      $this->erreur = $e->getMessage();
      $this->addLogErreur($this->erreur);
      $this->info = 'Une erreur est survenue lors de la création du crawler de la page.';
      $this->cheminFichierCsv = '';
      return sfView::SUCCESS;
    }

    $tester = new Tester($page,
                         $this->tests,
                         sfContext::getInstance()->getLogger());
    try
    {
      $tester->createExecutionList();
    }
    catch (KcatoesTesterException $e)
    {
      $this->erreur = $e->getMessage();
      $this->addLogErreur($this->erreur);
      $this->info = 'Une erreur est survenue lors de la création de la liste des tests à exécuter.';
      $this->cheminFichierCsv = '';
      return sfView::SUCCESS;
    }

    $tester->executeTest();
    $this->erreur = '';
    $this->info = 'Traitement terminé';
    $this->cheminFichierCsv = $tester->toCSV();
  }

  public function executeDev(sfWebRequest $request)
  {
    $this->tests = Doctrine::getTable('Test')->createQuery()->select()->execute();

    foreach($this->tests as $test)
    {
      $fileName = 'dev\\'.$test->getNomCourt().'.class.php';
      $contenu =
        '<?php'."\n".
        "\n".
        'class '.$test->getNomCourt().' extends ASource'."\n".
        '{'."\n".
        '  public function __construct()'."\n".
        '  {'."\n".
        '  }'."\n".
        "\n".
        '  public function execute(Page $page)'."\n".
        '  {'."\n".
        '    '."\n".
        '  }'."\n".
        '}';
      $file = @fopen($fileName, "w");
      if($file){
        fprintf($file, $contenu);
        fclose($file);
      }
    }
  }

  /**
   * Ajoute un message d'erreur au journal de log
   *
   * @param String $errorMessage Message à ajouter
   */
  private function addLogErreur($errorMessage)
  {
    sfContext::getInstance()->getLogger()->err($errorMessage);
  }

  /**
   * Ajoute un message d'information au journal de log
   *
   * @param String $infoMessage Message à ajouter
   */
  private function addLogInfo($infoMessage)
  {
    sfContext::getInstance()->getLogger()->info($infoMessage);
  }

  /**
   * Valide les données saisies dans un formulaire
   *
   * @param sfWebRequest $request La requête contenant les données à valider
   * @param sfForm       $form    Le fomulaire à valider
   */
  private function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    return $form->isValid();
  }

  /**
   * Extrait le contenu d'un site web sous forme de string après avoir vérifié
   * la validité de son URL
   *
   * @param string $url L'url de la page
   * @throws KcatoesUrlReadException
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
}
