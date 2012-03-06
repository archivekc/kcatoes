<?php
use Symfony\Component\DomCrawler\Crawler;
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(1);

$page = new Page('http://dev.kcatoes.local/dev/test.html');
$page->buildCrawler();

$test = new AbsenceDeLElementBlink();
$test->execute($page);

$t->comment('Proof of concept du test unitaire de l\'implémentation d\'un test');
$t->is($test->getExplication(), 'La page contient 1 élément(s) blink');