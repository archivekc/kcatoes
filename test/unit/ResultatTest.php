<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(5);
$reussite = new Resultat(Resultat::REUSSITE, '');
$echec = new Resultat(Resultat::ECHEC, '');
$manuel = new Resultat(Resultat::MANUEL, '');
$nonExec = new Resultat(Resultat::NON_EXEC);
$nonExec->setExplicationErreur('Ce test n\'est pas executable');
$erreur = new Resultat(Resultat::ERREUR);
$erreur->setExplicationErreur('Ce test a provoque une erreur');

$t->comment('Controle de la fonction getCode() de Resultat');
$t->comment('Resultat du test => \'Valeur de getCode() attendue\'');

$t->is(
  $reussite->getCode(true),
  'Réussite',
  'Reussite => \'Réussite\''
);
$t->is(
  $echec->getCode(true),
  'Echec',
  'Echec => \'Echec\''
);
$t->is(
  $manuel->getCode(true),
  'Exécution manuelle',
  'Execution manuelle => \'Exécution manuelle\''
);
$t->is(
  $nonExec->getCode(true),
  'Non exécutable: Ce test n\'est pas executable',
  'Non executable => \'Ce test n\'est pas executable\''
);
$t->is(
  $erreur->getCode(true),
  'Erreur d\'exécution: Ce test a provoque une erreur',
  'Erreur d\'exécution => \'Erreur d\'exécution: Ce test a provoque une erreur\''
);
