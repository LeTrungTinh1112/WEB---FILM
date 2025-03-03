<?php

if(isset($_GET['MaQuyen'])){
    $maQuyen = $_GET['MaQuyen'];
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();
$sql = "DELETE FROM quyen WHERE MAQUYEN = '$maQuyen'";
$conn->executeQuery($sql);

$sqlDelete = "DELETE FROM chitietquyen_chucnang WHERE MAQUYEN = '$maQuyen'";
$conn->executeQuery($sqlDelete);
$conn->disconnect();
}


?>