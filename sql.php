<?php
$host = 'localhost'; //change this to something like 'frigg.trentu.ca' when uploading
if('localhost' == $host)
	{$mysqlUser = "root";
	$mysqlPW = "";
	$db = 'vidlib';
	}
else
	{$mysqlUser = 'theodorecooke';
	$mysqlPW = 'Keyboard12';
	$db = 'theodorecooke';
	}
	$host = 'localhost';
$sql = new mysqli($host, $mysqlUser, $mysqlPW, $db); //make new sql object $sql, and connect
if($sql->connect_error) //if connection failed
	die ('Connect Error ('.$sql->connect_errno.') '. //print the error message
	$sql->connect_error.'.  '.$sql->sqlstate);
	$sql->set_charset('UTF-8'); //probably helps with any sort of char encoding problems
	
?>