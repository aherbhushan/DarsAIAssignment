<?php
require 'connect.php';
/*$val = $_REQUEST['selectedValue'];
echo $val;*/
$var=$_REQUEST['option'];

$varia = explode(',',$var);
//print_r($varia);



 $sql = "UPDATE video SET cat_id = $varia[1]  WHERE v_id = $varia[0]";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();

?>