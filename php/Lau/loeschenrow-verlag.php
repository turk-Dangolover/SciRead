<?php
require_once 'connect-server.php';
$id = $_POST['id'];
$sql = "DELETE FROM verlag WHERE id = $id";
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
header("Location: addVerlag.php");
?>