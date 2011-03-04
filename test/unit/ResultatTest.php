<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(5);
$reussite = new Resultat(Resultat::REUSSITE, '');
$echec = new Resultat(Resultat::ECHEC, '');
$manuel = new Resultat(Resultat::MANUEL, '');
$nonExec = new Resultat(Resultat::NON_EXEC, 'Ce test n\'est pas executable');
$erreur = new Resultat(Resultat::ERREUR, 'Ce test a provoque une erreur');

$t->comment('Controle de la fonction __toString() de Resultat');
$t->comment('Resultat du test => \'Valeur de __toString() attendue\'');

$t->is(
  (String)$reussite,
  'Terminé: Réussite',
  'Reussite => \'Terminé: Réussite\''
);
$t->is(
  (String)$echec,
  'Terminé: Echec',
  'Echec => \'Terminé: Echec\''
);
$t->is(
  (String)$manuel,
  'Terminé: Exécution manuelle',
  'Execution manuelle => \'Terminé: Exécution manuelle\''
);
$t->is(
  (String)$nonExec,
  'Non exécutable: Ce test n\'est pas executable',
  'Non executable => \'Ce test n\'est pas executable\''
);
$t->is(
  (String)$erreur,
  'Erreur d\'exécution: Ce test a provoque une erreur',
  'Erreur d\'exécution => \'Erreur d\'exécution: Ce test a provoque une erreur\''
);
