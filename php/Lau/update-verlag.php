<?php
require_once 'connect-server.php';
$id = $_POST['publisher_id'];
$newName=$_POST['newName'];
$newComment=$_POST['newComment'];
$sql = "UPDATE publisher SET name = :newName, comment = :newComment WHERE publisher_id = :publisher_id";
$stmt = $dbConnection->prepare($sql);
$stmt->bindParam(':newName', $newName);
$stmt->bindParam(':newComment', $newComment);
$stmt->bindParam(':publisher_id', $id);
$stmt->execute();
header("Location: addVerlag.php");
?>