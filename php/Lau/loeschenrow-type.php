<?php
require_once 'connect-server.php';
$id = $_POST['type_id'];
$sql = "DELETE FROM type WHERE type_id = $id";
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
header("Location: addType.php");
?>