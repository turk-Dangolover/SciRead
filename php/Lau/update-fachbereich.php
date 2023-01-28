
<?php
require_once 'connect-server.php';
$id = $_POST['fachbereich_id'];
$newFachbereich=$_POST['newFachbereich'];
$newComment=$_POST['newComment'];
$sql = "UPDATE fachbereich SET fachbereich = :newFachbereich, comment = :newComment WHERE fachbereich_id = :fachbereich_id";
$stmt = $dbConnection->prepare($sql);
$stmt->bindParam(':newFachbereich', $newFachbereich);
$stmt->bindParam(':newComment', $newComment);
$stmt->bindParam(':fachbereich_id', $id);
$stmt->execute();
header("Location: addFachbereich.php");
?>