<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(10);
$test = new Test();

$t->comment('Generation du nom court');
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
