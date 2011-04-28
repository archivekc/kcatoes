<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(19);

$page = new Page('', 'http://www.keyconsulting.fr');

$test1 = new Test();
$test1->setNom('Test 1');

$test2 = new Test();
$test2->setNom('Test 2');
$test2->setDependanceId(1);
$test2->setDependance($test1);
$test2->setExecuteSi(Resultat::ECHEC);

$test3 = new Test();
$test3->setNom('Test 3');
$test3->setDependanceId(2);
$test3->setDependance($test2);
$test2->setExecuteSi(Resultat::ECHEC);

$test4 = new Test();
$test4->setNom('Test 4');


$t->comment('Test independant');

$tester = new Tester($page, array($test1));
$tester->createExecutionList();
$executionList = array_values($tester->getExecutionList());

$t->is(count($executionList), 1, 'Nombre de tests a executer');
$t->is($executionList[0], $test1, 'Test a executer');

$tester->executeTest();
$executionList = array_values($tester->getExecutionList());
$resultat = $executionList[0]->getResultat();

$t->is(
  $resultat->getCode(true),
  'Réussite',
  'Resultat de l\'execution'
);


$t->comment('Test dependant sans ses dependances');

$tester = new Tester($page, array($test3));
$tester->createExecutionList();
$executionList = array_values($tester->getExecutionList());

$t->is(count($executionList), 3, 'Nombre de tests a executer');
$t->is($executionList[0], $test1, 'Test a executer');
$t->is($executionList[1], $test2, 'Test a executer');
$t->is($executionList[2], $test3, 'Test a executer');

$tester->executeTest();
$executionList = array_values($tester->getExecutionList());
$resultat1 = $executionList[0]->getResultat();
$resultat2 = $executionList[1]->getResultat();
$resultat3 = $executionList[2]->getResultat();

$t->is(
  $resultat1->getCode(true),
  'Réussite',
  'Resultat de l\'execution'
);
$t->is(
  $resultat2->getCode(true),
  'Non exécutable: Le résultat de sa dépendance directe ne correspond pas à '.
  'celui attendu pour pouvoir executer le test',
  'Resultat de l\'execution'
);
$t->is(
  $resultat3->getCode(true),
  'Non exécutable: La dépendance directe du test n\'a pas pu être exécutée',
  'Resultat de l\'execution'
);


$t->comment('Test dependant avec ses dependances');

$tester = new Tester($page, array($test1, $test4, $test3, $test2));
$tester->createExecutionList();
$executionList = array_values($tester->getExecutionList());

$t->is(count($executionList), 4, 'Nombre de tests a executer');
$t->is($executionList[0], $test1, 'Test a executer');
$t->is($executionList[1], $test4, 'Test a executer');
$t->is($executionList[2], $test2, 'Test a executer');
$t->is($executionList[3], $test3, 'Test a executer');

$tester->executeTest();
$executionList = array_values($tester->getExecutionList());
$resultat1 = $executionList[0]->getResultat();
$resultat2 = $executionList[1]->getResultat();
$resultat3 = $executionList[2]->getResultat();
$resultat4 = $executionList[3]->getResultat();

$t->is(
  $resultat1->getCode(true),
  'Réussite',
  'Resultat de l\'execution'
);
$t->is(
  $resultat2->getCode(true),
  'Non exécutable: Impossible de trouver l\'implémentation',
  'Resultat de l\'execution'
);
$t->is(
  $resultat3->getCode(true),
  'Non exécutable: Le résultat de sa dépendance directe ne correspond pas à '.
  'celui attendu pour pouvoir executer le test',
  'Resultat de l\'execution'
);

$t->is(
  $resultat4->getCode(true),
  'Non exécutable: La dépendance directe du test n\'a pas pu être exécutée',
  'Resultat de l\'execution'
);
