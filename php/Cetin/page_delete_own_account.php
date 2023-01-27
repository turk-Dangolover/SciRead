<!--
Erstellt von Cem Cetin
Datum: 10.01.2023
Beschreibung: Seite zum Löschen des eigenen Accounts
-->

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SciRead | Passwort ändern</title>
    <!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
// Header wird eingebunden
include_once "../Dreessen/navbar.php";
// Verbindung zur Datenbank
require 'connect.php';
// Prüft ob der User eingelogt ist
if(isset($_SESSION['login'])){
	// Holt die Rolle des Users aus der Session
	$login = $_SESSION['login'];
}
// Falls der User nicht eingelogt ist, wird Ihn eine Fehlermeldung angezeigt
if(!$login){
	include_once "401.php";
	return;
}
 ?>
<div class="container">
	<div class= "card"> 
		<div class="card-header">
			<h3>Account löschen</h3>
		</div>
		<div class="card-body container-fluid">
			<form action="function_delete_account.php" method="post">
				<div class="form-group">
					<label for="current_password">Aktuelles Passwort:</label>
					<input type="password" class="form-control" id="current_password" name="current_password" required>
				</div>
				<br>
				<input type="submit" class="btn btn-primary" value="Bestätigen">
			</form>
		</div>
	</div>
</div>
<!-- Footer einbinden	   -->
<?php
include_once "../Dreessen/footer.php";
?>
</body>
</html>
