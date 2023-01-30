<!Doctype html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SciRead | Datenbankentitäten</title>
</head>

<body>
  <?php include_once "../Dreessen/navbar.php";
   if (!isset($_SESSION['user_id'])) {
    include_once('../Cetin/401.php');
    return;
  }
  $user_id = $_SESSION['user_id'];
  $role = $_SESSION['roles_id'];
  if(!isset($role) ||$role==2) {
    include_once('../Cetin/401.php');
    return;
  } 
  ?>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3>Administrationsbereich</h3>
      </div>
    <div class="card-body text-center container-fluid">
      <div class="list-group">
        <h4 class="list-group-item list-group-item-action active">Datenbankentitäten</h4>
        <a href="../Lau/addFachbereich.php" class="list-group-item list-group-item-action ">Fachbereiche</a>
        <a href="../Lau/addType.php" class="list-group-item list-group-item-action ">Typen</a>
        <a href="../Lau/addVerlag.php" class="list-group-item list-group-item-action">Verläge</a>
        </div>
    </div>
<?php include_once '../Dreessen/footer.php' ?>
  </body>
</html>