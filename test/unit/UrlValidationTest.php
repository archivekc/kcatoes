<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(6);
$urlValide = 'http://www.keyconsulting.fr/';


$t->comment('Test de la validation d\'URL');

$t->is(UrlValidation::isSyntaxeValide($urlValide), true, 'Test de syntaxe sur: '.$urlValide);
$t->is(UrlValidation::isDnsValide($urlValide), true, 'Test de connexion sur: '.$urlValide);
$t->is(UrlValidation::isValide($urlValide), true, 'Test de validite sur: '.$urlValide);

$t->is(UrlValidation::isSyntaxeValide('toto'), false, 'Test de syntaxe sur: toto');
$t->is(UrlValidation::isDnsValide('http://www.jesuisdeconnecte.fr'), false, 'Test de connexion sur: http://www.jesuisdeconnecte.fr');
$t->is(UrlValidation::isValide('toto'), false, 'Test de validite sur: toto');