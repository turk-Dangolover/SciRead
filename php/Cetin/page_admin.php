<!--
Erstellt von Cem Cetin
Beschreibung: Bereich für den Admin mit allen Funktionen
-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>SciReader | Admin Bereich</title>
</head>
<body>
<?php
// Header wird eingebunden
include_once "../Dreessen/navbar.php";
// Verbindung zur Datenbank
require 'connect.php';
// Prüft ob der User eingelogt ist
if(!(isset($_SESSION['roles_id']))){
    include_once "401.php";
    return;
}
// Holt die Rolle des Users aus der Session
$role = $_SESSION['roles_id'];
// Falls der User kein Admin ist, wird Ihn eine Fehlermeldung angezeigt
if(!($role == '1')){
    include_once "401.php";
    return;
    }
 ?>
<!-- Falls der User ein Admin ist, wird ihn der Inhalt der Seite angezeigt -->
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Admin Bereich</h3>
        </div>
        <div class="card-body text-center container-fluid">
            <div class="list-group">
                <h4 class="list-group-item list-group-item-action active">Listen</h4>
                <a href="page_admin_accounts.php" class="list-group-item list-group-item-action ">Liste aller Accounts</a>
                <a href="../Lau/Administrationsbereich.php" class="list-group-item list-group-item-action ">Datenbank Entitäten</a>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../Dreessen/footer.php";
?>
</body>
</html>