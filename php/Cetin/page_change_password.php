<!--
Erstellt von Cem Cetin
Beschreibung: Seite zum Ändern des Passworts
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
// Navbar einbinden
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
			<h3>Passwort ändern</h3>
		</div>
		<div class="card-body container-fluid">
			<form action="function_change_password.php" method="post" >
				<div class="form-group">
					<label for="current_password">Aktuelles Passwort:</label>
					<input type="password" class="form-control" id="current_password" name="current_password" required>
				</div>
				<div class="form-group">
					<label for="new_password">Neues Passwort:</label>
					<input type="password" class="form-control" id="new_password" name="new_password" minlength="8" required pattern=".{8,}" title="Das Passwort muss mindestens 8 Zeichen lang sein."/>
				</div>
				<div class="form-group">
					<label for="confirm_password">Neues Passwort bestätigen:</label>
					<input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="8" required pattern=".{8,}" title="Das Passwort muss mindestens 8 Zeichen lang sein."/>
				</div>
				<br>
				<input type="submit" name="submit" class="btn btn-primary" value="Passwort ändern">
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

<script>
	window.onload = function() {
		// Check for the success parameter
		switch (new URL(window.location.href).searchParams.get("success")) {
    case "0":
        alert("Passwort erfolgreich geändert!")
        break;
    case "1":
		alert("Passwörter stimmen nicht überein!")
        break;
    case "2":
		alert("Falsches Passwort!")
        break;
	case "3":
		alert("Fehler!")
        break;
    default:
	break;
}
	}
</script>