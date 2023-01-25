<?php
require_once 'connect-server.php';
$id = $_POST['id'];
$sql = "DELETE FROM typ WHERE id = $id";
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
header("Location: addType.php");
?>