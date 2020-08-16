<?php
require 'connect.php';

$vid = $_GET['vid'];
$cat_id = $_GET['cat_id'];


$sql = "UPDATE video SET cat_id = 1 WHERE v_id = $vid";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$_SESSION['message'] = "MOVED TO uncategorised";

header("Location:un.php");



?>