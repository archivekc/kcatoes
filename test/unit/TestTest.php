<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(24);
$test = new Test();
$page = new Page('http://www.keyconsulting.fr');


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


$t->comment('Controle de la fonction isAutomatisable()');

$t->comment('Test non automatisable');
$test->setAutomatisable(false);
$t->is($test->isAutomatisable(), false, 'Renvoi false pour un test non automatisable');
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::MANUEL,
  'Un test non automatisable a pour resultat \'Execution manuelle\''
);

$t->comment('Test automatisable');
$test->setAutomatisable(true);
$t->is($test->isAutomatisable(), true, 'Renvoi true pour un test automatisable');


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
  $test->getResultat()->explication,
  'Impossible de trouver l\'implémentation',
  'Un test non implemente a pour explication \'Impossible de trouver l\'implémentation\''
);

$t->comment('Test mal implemente (n\'heritant pas de ASource)');
$test->setNom('Mal implémenté');
$t->is($test->isExecutable(), false, 'Un test mal implemente n\'est pas executable');
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::NON_EXEC,
  'Un test mal implemente a pour resultat \'Non executable\''
);
$t->is(
  $test->getResultat()->explication,
  'La classe n\'hérite pas de ASource',
  'Un test mal implemente a pour explication \'La classe n\'hérite pas de ASource\''
);

$t->comment('Test bien implemente');
$test->setNom('Bien implémenté');
$t->is($test->isExecutable(), true, 'Un test bien implemente est executable');


$t->comment('Controle de la fonction execute(Page $page)');

$t->comment('Test passe avec succes');
$test->setNom('Réussite');
$test->execute($page);
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::REUSSITE,
  'Un test passe avec succes a pour resultat \'Reussite\''
);

$t->comment('Test echoue');
$test->setNom('Echec');
$className = $test->getNomCourt();
$class = new $className();
$test->execute($page);
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::ECHEC,
  'Un test qui a echoue a pour resultat \'Echec\''
);
$t->is(
  $test->getResultat()->explication,
  $class->getExplication(),
  'Un test qui a echoue a pour explication celles indiquees dans son implementation'
);

$t->comment('Test provoquant une erreur');
$test->setNom('Erreur');
$test->execute($page);
$t->is(
  $test->getResultat()->resultatCode,
  Resultat::ERREUR,
  'Un test provoquant une erreur a pour resultat \'Erreur\''
);
