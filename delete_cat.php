<?php
require 'connect.php';
session_start();

$vid = $_GET['vid'];

if (isset($_GET)) {
	$sql = "DELETE FROM video WHERE v_id=:vid";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':vid'=>$vid));


	$_SESSION['me'] = "DELETED";

	header("Location:un.php");
}

?>