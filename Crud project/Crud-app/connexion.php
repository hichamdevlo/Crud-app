<?php

$dsn="mysql:host=localhost;dbname=books_library";
$user="root";
$pass="";
$option= array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8");

try 

{
	$conn = new PDO($dsn,$user,$pass,$option);
	$conn->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "";
}

catch(PDOEXCEPTION $e)

{
 	echo "";
}


?>