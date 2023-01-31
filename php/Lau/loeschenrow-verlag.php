<?php
 if (!isset($_SESSION['user_id'])) {
    include_once('../Cetin/401.php');
    return;
  }
  $user_id = $_SESSION['user_id'];
  $role = $_SESSION['roles_id'];
  if(!isset($role) ||$role==2){
    include_once ('../Cetin/401.php');
    return;
    }
require_once 'connect-server.php';
$id = $_POST['publisher_id'];
$sql = "UPDATE literatur SET publisher_id = :filler WHERE publisher_id = :id";
$stmt = $dbConnection->prepare($sql);
$stmt->bindValue(':filler', NULL);
$stmt->bindValue(':id', $id);
$stmt->execute();

$sql = "DELETE FROM publisher WHERE publisher_id = $id";
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
header("Location: addVerlag.php");
?>