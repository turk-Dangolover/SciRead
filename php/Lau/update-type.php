
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