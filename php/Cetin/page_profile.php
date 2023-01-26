<!--
Erstellt von Cem Cetin
Datum: 07.01.2023
Beschreibung: Verwaltung des Profils
-->

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link  rel="stylesheet" href="../../css/style.css">
    <title>Document</title>
</head>
<?php
include_once "../Dreessen/navbar.php";
    // Verbindung zur Datenbank
   require 'connect.php';
    // Holt die Rolle des Users aus der Session
    if(isset($_SESSION['login'])){
        $login = $_SESSION['login'];
    }
   // Falls der User ein Admin ist, wird ihn der Inhalt der Seite angezeigt
   if(!$login){
    include_once "401.php";
        // Falls der User kein Admin ist, wird Ihn eine Fehlermeldung angezeigt
        return;
    }
 ?>
<body>
<!-- Inhalt der Website -->
<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Profile</h3>
    </div>
    <div class="card-body text-center container-fluid">
      <div class="list-group">
        <h4 class="list-group-item list-group-item-action active">Persönliche Daten</h4>
        <a href="#" class="list-group-item list-group-item-action ">Persönliche Einträge anzeigen</a>
        <a href="#" class="list-group-item list-group-item-action">Persönlichen Eintrag hinzufügen</a>
        <a href="#" class="list-group-item list-group-item-action">Datenbankeinträge anzeigen</a>
        <a href="#" class="list-group-item list-group-item-action">Datenbankeintrag hinzufügen</a>
      </div>
      <br class="col-1">
      <div class="list-group">
        <h4 class="list-group-item list-group-item-action active">Account</h4>
        <a href="page_change_password.php" class="list-group-item list-group-item-action ">Passwort ändern</a>
        <a href="page_delete_own_account.php" class="list-group-item list-group-item-action onClick="confirmDelete()">Account löschen</a>
      </div>
    </div>
  </div>
</div>
<?php
include_once "../Dreessen/footer.php";
?>
</body>
</html>
<script>function confirmDelete() {
    var password = prompt("Please enter your password to confirm account deletion:");
    if (password == null || password == "") {
      alert("Account deletion cancelled.");
    } else {
      var confirmation = confirm("Are you sure you want to delete your account?");
      if (confirmation) {
        // Perform account deletion using the entered password
      } else {
        alert("Account deletion cancelled.");
      }
    }
  }
  </script>