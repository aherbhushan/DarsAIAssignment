<?php 
require 'connect.php';
session_start();

$vid = $_GET['vid'];

if (isset($_GET)) {

	$query = "DELETE FROM video WHERE v_id=:vid";
	$stmt = $pdo->prepare($query);
	$stmt->execute(array(':vid'=>$vid));

	$_SESSION['me'] = "Deleted";

	header("Location:index.php");
}
?>