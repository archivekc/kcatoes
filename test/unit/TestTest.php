<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(25);
$test = new Test();
$page = new Page('', 'http://www.keyconsulting.fr');


$t->comment('Controle de la generation du nom court');
$t->comment('\'Nom du test\' => \'Nom court attendu\'');

$test->setNom('Toto');
$t->is($test->getNomCourt(), 'Toto', '\'Toto\' => \'Toto\'');

$test->setNom('toto-toto');
$t->is($test->getNomCourt(), 'TotoToto', '\'toto-toto\' => \'TotoToto\'');

$test->setNom('Toto toto');
$t->is($test->getNomCourt(), 'TotoToto', '\'Toto toto\' => \'TotoToto\'');

$test->setNom('TotoToTo');
$t->is($test->getNomCourt(), 'Totototo', '\'TotoToTo\' => \'Totototo\'');

$test->setNom('toto');
$t->is($test->getNomCourt(), 'Toto', '\'toto\' => \'Toto\'');

$test->setNom('éèàçùûêî');
$t->is($test->getNomCourt(), 'Eeacuuei', '\'éèàçùûêî\' => \'Eeacuuei\'');

$test->setNom('tété@toto.fr');
$t->is($test->getNomCourt(), 'TeteTotoFr', '\'tété@toto.fr\' => \'TeteTotoFr\'');

$test->setNom('  tro  ');
$t->is($test->getNomCourt(), 'Tro', '\'  tro  \' => \'Tro\'');

$test->setNom("\t toto \n");
$t->is($test->getNomCourt(), 'Toto', '\'\t toto \n\' => \'Toto\'');

$test->setNom('test numero 10');
$t->is($test->getNomCourt(), 'TestNumero10', '\'test numero 10\' => \'TestNumero10\'');


$t->comment('Controle de la fonction isExecutable()');

$t->comment('Test non implemente');
$test->setNom('Pas implémenté');
$t->is($test->isExecutable(), false, 'Un test non implemente n\'est pas executable');
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::NON_EXEC,
  'Un test non implemente a pour resultat \'Non executable\''
);
$t->is(
  $test->getResultat()->explicationErreur,
  'Impossible de trouver l\'implémentation',
  'Un test non implemente a pour explication \'Impossible de trouver l\'implémentation\''
);

$t->comment('Test mal implemente (n\'heritant pas de ASource)');
$test->setNom('Test mal implémenté');
$t->is($test->isExecutable(), false, 'Un test mal implemente n\'est pas executable');
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::NON_EXEC,
  'Un test mal implemente a pour resultat \'Non executable\''
);
$t->is(
  $test->getResultat()->explicationErreur,
  'La classe n\'hérite pas de ASource',
  'Un test mal implemente a pour explication \'La classe n\'hérite pas de ASource\''
);

$t->comment('Test bien implemente');
$test->setNom('Test bien implémenté');
$t->is($test->isExecutable(), true, 'Un test bien implemente est executable');


$t->comment('Controle de la fonction execute(Page $page)');

$t->comment('Test passe avec succes');
$test->setNom('Test réussite');
$test->execute($page);
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::REUSSITE,
  'Un test passe avec succes a pour resultat \'Reussite\''
);

$t->comment('Test echoue');
$test->setNom('Test echec');
$className = $test->getNomCourt();
$class = new $className();
$test->execute($page);
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::ECHEC,
  'Un test qui a echoue a pour resultat \'Echec\''
);
$complements = $class->getComplements();
$t->is(
  $test->getResultat()->echecs->explication,
  $complements[0]>explication,
  'Un test qui a echoue a pour explication celles indiquees dans son implementation'
);

$t->comment('Test provoquant une erreur');
$test->setNom('Test erreur');
$test->execute($page);
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::ERREUR,
  'Un test provoquant une erreur a pour resultat \'Erreur\''
);


$t->comment('Controle de la fonction getLongName()');

$test->setNom('Test');
$test->setDescription('un test');
$t->is(
  $test->getLongName(),
  'Test, un test',
  'Le nom long d\'un test est la combinaison de son nom et de sa description'
);


$t->comment('Controle de la fonction getExecutionList()');

$test1 = new Test();
$test1->setNom('Test 1');

$test2 = new Test();
$test2->setNom('test 2');
$test2->setDependanceId(1);
$test2->setDependance($test1);
$test2->setExecuteSi(Resultat::ECHEC);

$test3 = new Test();
$test3->setNom('Test 3');
$test3->setDependanceId(2);
$test3->setDependance($test2);
$test2->setExecuteSi(Resultat::ECHEC);

$dependances = array_values($test3->getExecutionList());

$t->is(
  count($dependances),
  2,
  'getExecutionList renvoie la liste des dependances a executer pour pouvoir executer un test'
);

$dependance1 = $dependances[0];
$t->is(
  $dependance1,
  $test1,
  'La premiere dependance recuperee correspond au seul test independant de la liste'
);

$dependance2 = $dependances[1];
$t->is(
  $dependance2,
  $test2,
  'La derniere dependance recuperee correspond a la dependance directe du test'
);