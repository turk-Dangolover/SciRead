<?php
require_once 'connect-server.php';
$id = $_POST['type_id'];
$sql = "UPDATE literatur SET type_id = :filler WHERE type_id = :id";
$stmt = $dbConnection->prepare($sql);
$stmt->bindValue(':filler', NULL);
$stmt->bindValue(':id', $id);
$stmt->execute();

$sql = "DELETE FROM type WHERE type_id = $id";
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
header("Location: addType.php");
?>