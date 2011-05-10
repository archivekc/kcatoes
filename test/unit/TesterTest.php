<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(17);

$page = new Page('');

$test1 = Doctrine_Core::getTable('Test')->findOneByNom('Test unitaire 1');
$test2 = Doctrine_Core::getTable('Test')->findOneByNom('Test unitaire 2');
$test3 = Doctrine_Core::getTable('Test')->findOneByNom('Test unitaire 3');
$test4 = Doctrine_Core::getTable('Test')->findOneByNom('Test unitaire 4');

$t->comment('Test independant');

$tester = new Tester($page, array($test1->getId()));
$executionList = array_values($tester->createExecutionList());

$t->is(count($executionList), 1, 'Nombre de tests a executer');
$t->is($executionList[0]->getNom(), $test1->getNom(), 'Test a executer');

$tester->executeTest();
$tests = $tester->getTests();
$resultat = $tests[0]->getResultat();

$t->is(
  $resultat->getCode(true),
  'Réussite',
  'Resultat de l\'execution'
);


$t->comment('Test dependant sans ses dependances');

$tester = new Tester($page, array($test3->getId()));
$executionList = array_values($tester->createExecutionList());

$t->is(count($executionList), 3, 'Nombre de tests a executer');
$t->is($executionList[0]->getNom(), $test1->getNom(), 'Test a executer');
$t->is($executionList[1]->getNom(), $test2->getNom(), 'Test a executer');
$t->is($executionList[2]->getNom(), $test3->getNom(), 'Test a executer');

$tester->executeTest();
$tests = array_values($tester->getTests());
$resultat1 = $tests[0]->getResultat();

$t->is(
  $resultat1->getCode(true),
  'Non exécutable: La dépendance directe du test n\'a pas pu être exécutée',
  'Resultat de l\'execution'
);


$t->comment('Test dependant avec ses dependances');

$tester = new Tester(
  $page,
  array(
    $test1->getId(),
    $test4->getId(),
    $test3->getId(),
    $test2->getId()
  )
);
$executionList = array_values($tester->createExecutionList());

$t->is(count($executionList), 4, 'Nombre de tests a executer');
$t->is($executionList[0]->getNom(), $test1->getNom(), 'Test a executer');
$t->is($executionList[1]->getNom(), $test2->getNom(), 'Test a executer');
$t->is($executionList[2]->getNom(), $test3->getNom(), 'Test a executer');
$t->is($executionList[3]->getNom(), $test4->getNom(), 'Test a executer');

$tester->executeTest();
$tests = array_values($tester->getTests());
$resultat1 = $tests[0]->getResultat();
$resultat2 = $tests[1]->getResultat();
$resultat3 = $tests[2]->getResultat();
$resultat4 = $tests[3]->getResultat();

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
$t->is(
  $resultat4->getCode(true),
  'Non exécutable: Impossible de trouver l\'implémentation',
  'Resultat de l\'execution'
);
