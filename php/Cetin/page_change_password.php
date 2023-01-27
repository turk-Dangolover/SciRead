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
	<title>Passwort ändern</title>
    <!-- Bootstrap CSS -->
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
						<input type="password" class="form-control" id="new_password" name="new_password" required>
				</div>
			<div class="form-group">
				<label for="confirm_password">Neues Passwort bestätigen:</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
			</div>
			<input type="submit" name="submit" class="btn btn-primary" value="Passwort ändern">
		</form>
		<br>
	</div>
	<div class="modal" tabindex="-1" id="successModal" role="dialog">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Erfolgreich</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  <p>Passwort erfolgreich geändert!</p>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="modal" tabindex="-1" id="successModal2" role="dialog">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Fehler</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  <p>Passwörter stimmen nicht überein!</p>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="modal" tabindex="-1" id="successModal3" role="dialog">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Fehler</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  <p>Falsches Passwort!</p>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="modal" tabindex="-1" id="successModal4" role="dialog">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Fehler</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  <p>Fehler!</p>
			</div>
		  </div>
		</div>
	  </div>
	  
</div>
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
        $("#successModal").modal("show");
        break;
    case "1":
	$("#successModal2").modal("show");
        break;
    case "2":
	$("#successModal3").modal("show");
        break;
	case "3":
	$("#successModal4").modal("show");
        break;
    default:
	break;
}
	}
</script>