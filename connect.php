<?php


$host = "Localhost";
$username = "root";
$password = "";
$dbname = "new";

$pdo = new PDO("mysql:host=localhost;dbname=new",$username,$password);

if (!$pdo) {
	echo "unable to connect";
}


?>