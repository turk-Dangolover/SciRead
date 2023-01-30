<?php
require_once 'connect-server.php';
$id = $_POST['fachbereich_id'];
$sql = "UPDATE literatur SET publisher_id = :filler WHERE publisher_id = :id";
$stmt = $dbConnection->prepare($sql);
$stmt->bindValue(':filler', NULL);
$stmt->bindValue(':id', $id);
$stmt->execute();

$sql = "DELETE FROM fachbereich WHERE fachbereich_id = $id";
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
header("Location: addFachbereich.php");
?>