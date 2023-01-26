<!--
Erstellt von Cem Cetin
Datum: 01.01.2023
Beschreibung: Bereich für den Admin mit allen Funktionen
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
        <link  rel="stylesheet" href="../css/style.css">
        <title>SciReader | Admin Bereich</title>
</head>
<body>
<?php
// Header wird eingebunden
include_once "../Dreessen/navbar.php";
// Verbindung zur Datenbank
require 'connect.php';
// Holt die Rolle des Users aus der Session
$role = $_SESSION['roles_id'];
// Falls der User ein Admin ist, wird ihn der Inhalt der Seite angezeigt
if(!($role == '1')){
    // Falls der User kein Admin ist, wird Ihn eine Fehlermeldung angezeigt
    header('Location: 401.php');
    return;
    }
 ?>
<!-- Inhalt der Website -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Admin Bereich</h3>
                </div>
                <div class="card-body text-center container-fluid">
                    <div class="list-group">
                        <h4 class="list-group-item list-group-item-action active">Listen</h4>
                        <a href="page_admin_accounts.php" class="list-group-item list-group-item-action ">Liste aller Accounts</a>
                        <a href="#" class="list-group-item list-group-item-action ">Datenbank Entitäten</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
