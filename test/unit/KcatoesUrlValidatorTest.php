<?php
require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

$t = new lime_test(10);
$urlValide = 'http://www.keyconsulting.fr/';
$metaValide = array(
  'wrapper_data' => array(
    'HTTP/1.1 200 OK',
    'Set-Cookie: mediaplan=R3721099505; path=/; expires=Thu, 03-Mar-2011 04:21:36 GMT',
    'Date: Mon, 28 Feb 2011 16:06:03 GMT',
    'Server: Apache/2.2.X (OVH)',
    'X-Powered-By: PHP/5.2.17',
    'Expires: Thu, 19 Nov 1981 08:52:00 GMT',
    'Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
    'Pragma: no-cache',
    'Set-Cookie: symfony=a16d2f373d60a1eb28f89198c8b1cb23; path=/',
    'Vary: Accept-Encoding',
    'Connection: close',
    'Content-Type: text/html; charset=utf-8'
  ),
  'wrapper_type' => 'http',
  'stream_type' => 'tcp_socket',
  'mode' => 'r',
  'unread_bytes' => '907',
  'seekable' => '',
  'uri' => 'http://www.keyconsulting.fr/',
  'timed_out' => '',
  'blocked' => '1',
  'eof' => ''
);
$metaInvalide = array(
  'wrapper_data' => array(
    'HTTP/1.1 302 Moved Temporarily',
    'Set-Cookie: mediaplan=R3721099505; path=/; expires=Thu, 03-Mar-2011 04:21:36 GMT',
    'Date: Mon, 28 Feb 2011 16:06:03 GMT',
    'Server: Apache/2.2.X (OVH)',
    'X-Powered-By: PHP/5.2.17',
    'Expires: Thu, 19 Nov 1981 08:52:00 GMT',
    'Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
    'Pragma: no-cache',
    'Set-Cookie: symfony=a16d2f373d60a1eb28f89198c8b1cb23; path=/',
    'Vary: Accept-Encoding',
    'Connection: close',
    'Content-Type: image/jpeg; charset=utf-8'
  ),
  'wrapper_type' => 'http',
  'stream_type' => 'tcp_socket',
  'mode' => 'r',
  'unread_bytes' => '907',
  'seekable' => '',
  'uri' => 'http://www.keyconsulting.fr/',
  'timed_out' => '',
  'blocked' => '1',
  'eof' => ''
);

$t->comment('Test de la validation d\'URL');
$t->comment('');
try
{
  $t->comment('Test de syntaxe sur: '.$urlValide);
  $t->comment('Doit passer sans lancer d\'exception');
  KcatoesUrlValidator::isSyntaxeValide($urlValide);
  $t->pass('Aucune exception n\'a ete recuperee');
}
catch(KcatoesUrlException $e)
{
	$t->fail('Une exception inattendue a ete recuperee: '.$e->getMessage());
}
try
{
  $t->comment('Test de connexion sur: '.$urlValide);
  $t->comment('Doit passer sans lancer d\'exception');
  KcatoesUrlValidator::isDnsValide($urlValide);
  $t->pass('Aucune exception n\'a ete recuperee');
}
catch(KcatoesUrlException $e)
{
  $t->fail('Une exception inattendue a ete recuperee: '.$e->getMessage());
}
try
{
  $t->comment('Test de code HTTP sur une meta donnee contenant un code 200');
  $t->comment('Doit passer sans lancer d\'exception');
  KcatoesUrlValidator::isCodeHttpValide($metaValide);
  $t->pass('Aucune exception n\'a ete recuperee');
}
catch(KcatoesUrlException $e)
{
  $t->fail('Une exception inattendue a ete recuperee: '.$e->getMessage());
}
try
{
  $t->comment('Test de type de page sur une meta donnee avec un Content-type text/html');
  $t->comment('Doit passer sans lancer d\'exception');
  KcatoesUrlValidator::isFormatValide($metaValide);
  $t->pass('Aucune exception n\'a ete recuperee');
}
catch(KcatoesUrlException $e)
{
  $t->fail('Une exception inattendue a ete recuperee: '.$e->getMessage());
}
try
{
  $t->comment('Test de validation d\'URL complet sur '.$urlValide);
  $t->comment('Doit passer sans lancer d\'exception');
  KcatoesUrlValidator::isValide($urlValide);
  $t->pass('Aucune exception n\'a ete recuperee');
}
catch(KcatoesUrlException $e)
{
  $t->fail('Une exception inattendue a ete recuperee: '.$e->getMessage());
}

try{
	$t->comment('Test de syntaxe sur: toto');
	$t->comment('Doit lancer une exception de type KcatoesUrlException');
	KcatoesUrlValidator::isSyntaxeValide('toto');
	$t->fail('L\'exception attendue n\'a pas ete recuperee');
}
catch(KcatoesUrlException $e)
{
	$t->pass('L\'exception attendue a ete recuperee: '.$e->getMessage());
}
try{
  $t->comment('Test de connexion sur: http://www.jesuisdeconnecte.fr');
  $t->comment('Doit lancer une exception de type KcatoesUrlException');
  KcatoesUrlValidator::isDnsValide('http://www.jesuisdeconnecte.fr');
  $t->fail('L\'exception attendue n\'a pas ete recuperee');
}
catch(KcatoesUrlException $e)
{
  $t->pass('L\'exception attendue a ete recuperee: '.$e->getMessage());
}
try
{
  $t->comment('Test de code HTTP sur une meta donnee contenant un code 302');
  $t->comment('Doit lancer une exception de type KcatoesUrlException');
  KcatoesUrlValidator::isCodeHttpValide($metaInvalide);
  $t->fail('L\'exception attendue n\'a pas ete recuperee');
}
catch(KcatoesUrlException $e)
{
  $t->pass('L\'exception attendue a ete recuperee: '.$e->getMessage());
}
try
{
  $t->comment('Test de type de page sur une meta donnee avec un Content-type image/jpeg');
  $t->comment('Doit lancer une exception de type KcatoesUrlException');
  KcatoesUrlValidator::isFormatValide($metaInvalide);
  $t->fail('L\'exception attendue n\'a pas ete recuperee');
}
catch(KcatoesUrlException $e)
{
  $t->pass('L\'exception attendue a ete recuperee: '.$e->getMessage());
}
try{
  $t->comment('Test de validite sur: toto');
  $t->comment('Doit lancer une exception de type KcatoesUrlException');
  KcatoesUrlValidator::isValide('toto');
  $t->fail('L\'exception attendue n\'a pas ete recuperee');
}
catch(KcatoesUrlException $e)
{
  $t->pass('L\'exception attendue a ete recuperee: '.$e->getMessage());
}
