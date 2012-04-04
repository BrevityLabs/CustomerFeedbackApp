<?php
$server =	"localhost" ; 		//substitute the value with your sql server name or IP
$login	=	"root" ;			//substitute the value with the user name
$password =	"mukulbiswas" ;		//substitute the password with the user password
$dbname	=	"twareachout" ;		//substitute the DB name with the one which has config values

$conn = mysql_connect($server, $login, $password) ;
if (!$conn) {
	die("connection failed " . mysql_error());
} 
$dbase = mysql_select_db($dbname, $conn) or die("database connection failed");

?>
