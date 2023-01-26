<?php
require_once 'connect-server.php';
$id = $_POST['publisher_id'];
$sql = "DELETE FROM publisher WHERE publisher_id = $id";
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
header("Location: addVerlag.php");
?>