<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(7);
$test = new Test();

$test->setNom('Toto');
$t->is($test->getNomCourt(), 'Toto', 'Test nominal: \'Toto\' => \'Toto\'');

$test->setNom('toto-toto');
$t->is($test->getNomCourt(), 'TotoToto', '\'toto-toto\' => \'TotoToto\'');

$test->setNom('Toto toto');
$t->is($test->getNomCourt(), 'TotoToto', '\'Toto toto\' => \'TotoToto\'');

$test->setNom('TotoToTo');
$t->is($test->getNomCourt(), 'Totototo', '\'TotoToTo\' => \'Totototo\'');

$test->setNom('toto');
$t->is($test->getNomCourt(), 'Toto', '\'toto\' => \'Toto\'');

$test->setNom('tété');
$t->is($test->getNomCourt(), 'Tete', '\'tété\' => \'Tete\'');

$test->setNom('tété@toto.fr');
$t->is($test->getNomCourt(), 'TeteTotoFr', '\'tété@toto.fr\' => \'TeteTotoFr\'');
