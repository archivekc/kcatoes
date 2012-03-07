<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(9);
$reussite = new Resultat(Resultat::REUSSITE, '');
$echec = new Resultat(Resultat::ECHEC, '');
$manuel = new Resultat(Resultat::MANUEL, '');
$nonExec = new Resultat(Resultat::NON_EXEC);
$nonExec->setExplicationErreur('Ce test n\'est pas executable');
$nonExecSansExplication = new Resultat(Resultat::NON_EXEC);
$erreur = new Resultat(Resultat::ERREUR);
$erreur->setExplicationErreur('Ce test a provoque une erreur');
$erreurSansExplication = new Resultat(Resultat::ERREUR);

$t->comment('Controle de la fonction getCode() de Resultat');

$t->is(
  $reussite->getCode(true),
  'Réussite',
  'Test reussit'
);
$t->is(
  $echec->getCode(true),
  'Echec',
  'Test echoue'
);
$t->is(
  $manuel->getCode(true),
  'Exécution manuelle',
  'Test necessitant une execution manuelle'
);
$t->is(
  $nonExec->getCode(true),
  'Non exécutable: Ce test n\'est pas executable',
  'Test non executable avec explication'
);
$t->is(
  $nonExec->getCode(false),
  'Non exécutable',
  'Test non executable sans explication'
);
$t->is(
  $nonExecSansExplication->getCode(true),
  'Non exécutable: n.a.',
  'Test non executable avec explication non definie'
);
$t->is(
  $erreur->getCode(true),
  'Erreur d\'exécution: Ce test a provoque une erreur',
  'Test rencontrant une erreur a l\'execution avec explication'
);
$t->is(
  $erreur->getCode(false),
  'Erreur d\'exécution',
  'Test rencontrant une erreur a l\'execution sans explication'
);
$t->is(
  $erreurSansExplication->getCode(true),
  'Erreur d\'exécution: n.a.',
  'Test rencontrant une erreur a l\'execution avec explication non definie'
);
