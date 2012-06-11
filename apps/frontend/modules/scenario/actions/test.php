<?php

// parse les argument dans la variable $_GET
//parse_str(implode('&', array_slice($argv, 1)), $_GET);

echo ('--');
die('123');

for ($i=0;$i<5;$i++)
{
	try {
		echo '.';
	} catch(Exception $e){
		echo 'ERROR-'.$e->getMessage(); 
	}
	sleep(1);
}
//echo dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'pendingTest'.DIRECTORY_SEPARATOR.$_GET['sId'].'DONE';

$f = fopen(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'pendingTesting'.DIRECTORY_SEPARATOR.$_GET['sId'].'DONE', 'w');
fclose($f);

exit(0);