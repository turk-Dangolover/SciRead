<!--
Erstellt von Cem Cetin
Beschreibung: Verwaltung des Profils und verlinkung zu den anderen Seiten
-->

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <title>SciRead | User</title>
</head>
<?php
// Header wird eingebunden
include_once "../Dreessen/navbar.php";
// Verbindung zur Datenbank
require 'connect.php';
// Prüft ob der User eingelogt ist
if (isset($_SESSION['login'])) {
  $login = $_SESSION['login'];
}
// Falls der User nicht eingelogt ist, wird Ihn eine Fehlermeldung angezeigt
if (!$login) {
  include_once "401.php";
  return;
}
?>
<body>
<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>User</h3>
    </div>
    <div class="card-body text-center container-fluid">
      <div class="list-group">
        <h4 class="list-group-item list-group-item-action active">Persönliche Daten</h4>
        <a href="../Kliefoth/bookmark_search.php" class="list-group-item list-group-item-action ">Persönliche Einträge anzeigen</a>
        <a href="../Kliefoth/user_book_search.php" class="list-group-item list-group-item-action">Datenbankeinträge anzeigen</a>
        <a href="../Dreessen/submit_page.php" class="list-group-item list-group-item-action">Datenbankeintrag hinzufügen</a>
      </div>
      <br>
      <div class="list-group">
        <h4 class="list-group-item list-group-item-action active">Account</h4>
        <a href="page_change_password.php" class="list-group-item list-group-item-action ">Passwort ändern</a>
        <a href="page_delete_own_account.php" class="list-group-item list-group-item-action">Account löschen</a>
      </div>
    </div>
  </div>
</div>
  <?php
  // Footer wird eingebunden
  include_once "../Dreessen/footer.php";
  ?>
</body>

</html>