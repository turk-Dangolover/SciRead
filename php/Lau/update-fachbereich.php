
<?php
include_once('../Dreessen/Navbar.php');
if (!isset($_SESSION['user_id'])) {
  include_once('../Cetin/401.php');
  return;
}
$user_id = $_SESSION['user_id'];
$role = $_SESSION['roles_id'];
if (!isset($role) || $role == 2) {
  include_once('../Cetin/401.php');
  return;
}
require_once 'connect-server.php';
$id = $_POST['fachbereich_id'];
$newFachbereich = $_POST['newFachbereich'];
$newComment = $_POST['newComment'];
$sql = "UPDATE fachbereich SET fachbereich = :newFachbereich, comment = :newComment WHERE fachbereich_id = :fachbereich_id";
$stmt = $dbConnection->prepare($sql);
$stmt->bindParam(':newFachbereich', $newFachbereich);
$stmt->bindParam(':newComment', $newComment);
$stmt->bindParam(':fachbereich_id', $id);
$stmt->execute();
header("Location: addFachbereich.php");
?>