<?php
use Symfony\Component\DomCrawler\Crawler;
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(1);

$content = file_get_contents('http://dev.kcatoes.local/dev/test.html');
$page = new Page($content, 'http://dev.kcatoes.local/dev/test.html');
$page->buildCrawler();

$test = new AbsenceDeLElementBlink();
$result = $test->execute($page);

$t->comment('Proof of concept du test unitaire de l\'implémentation d\'un test');
$t->is($result, Resultat::ECHEC);