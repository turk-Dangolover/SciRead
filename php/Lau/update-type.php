
<?php
require_once 'connect-server.php';
$id = $_POST['type_id'];
$newType=$_POST['newType'];
$newComment=$_POST['newComment'];
$sql = "UPDATE type SET type = :newType, comment = :newComment WHERE type_id = :type_id";
$stmt = $dbConnection->prepare($sql);
$stmt->bindParam(':newType', $newType);
$stmt->bindParam(':newComment', $newComment);
$stmt->bindParam(':type_id', $id);
$stmt->execute();
header("Location: addType.php");
?>