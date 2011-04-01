<?php

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
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('urlDeTest', 'http://dev.kcatoes.local/dev/test.html');
//    $this->getUser()->setAttribute('urlDeTest', 'http://www.keyconsulting.fr/');
    $this->getUser()->setAttribute('testsSelectionnes', array(8));

    //A terme, initialisé par la configuration des tests
    $this->urlDeTest = $this->getUser()->getAttribute('urlDeTest');
//    $this->urlDeTest = 'http://www.jesuisdeconnecte.fr';              //404
//    $this->urlDeTest = 'http://abonnes.lemonde.fr/';                  //302
//    $this->urlDeTest = 'jenesuispasunformatd\'URLvalide';             //Syntaxe invalide
//    $this->urlDeTest = 'http://www.keyconsulting.fr/images/sign.jpg'; //Format invalide

//    $listeIds = $this->getUser()->getAttribute('testsSelectionnes');
//    $this->tests = Doctrine::getTable('Test')->getCollectionFromIds($listeIds);
    $this->tests = Doctrine::getTable('Test')->getTestAutomatisable();

  }

  public function executeUrl(sfWebRequest $request)
  {
    $this->form = new UrlForm();
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->form))
      {
        $formContent = $request->getParameter($this->form->getName());
        $this->getUser()->setAttribute('url', $formContent['url']);
        $this->redirect('test/thematique');
      }
    }
  }

  public function executeThematique(sfWebRequest $request)
  {
    $this->form = new ThematiqueForm();
    if ($request->isMethod('post'))
    {
      if ($this->processForm($request, $this->form))
      {
        $formContent = $request->getParameter($this->form->getName());
        print_r($formContent);
      }
    }
  }

  public function executeReferentiel(sfWebRequest $request)
  {

  }

  public function executeRegroupement(sfWebRequest $request)
  {

  }

  public function executeTest(sfWebRequest $request)
  {

  }

  /**
   *
   *
   * @param sfWebRequest $request
   */
  public function executeExecute(sfWebRequest $request)
  {
    $this->urlDeTest = $this->getUser()->getAttribute('urlDeTest');
//    $listeIds = $this->getUser()->getAttribute('testsSelectionnes');
//    $this->tests = Doctrine::getTable('Test')->getCollectionFromIds($listeIds);
    $this->tests = Doctrine::getTable('Test')->getTestAutomatisable();

    $page = new page($this->urlDeTest, sfContext::getInstance()->getLogger());
    try
    {
      $page->buildCrawler();
    }
    catch (KcatoesCrawlerException $e)
    {
      $this->erreur = $e->getMessage();
      $this->info = 'Une erreur est survenue lors de la création du crawler de la page.';
      $this->cheminFichierCsv = '';
      return sfView::SUCCESS;
    }

    $tester = new Tester($page,
                         $this->tests,
                         sfContext::getInstance()->getLogger());
    $tester->executeTest();
    $this->erreur = '';
    $this->info = 'Traitement terminé';
    $this->cheminFichierCsv = $tester->toCSV();
  }

  public function executeDev(sfWebRequest $request)
  {
    $this->tests = Doctrine::getTable('Test')->getTestAutomatisable();

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
        '    $this->explication = \'\';'."\n".
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

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName())
    );

    return ($form->isValid()) ? true : false;
  }
}
