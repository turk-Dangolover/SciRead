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
	<title>Passwort ändern</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <link  rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
// Header wird eingebunden
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
		<h3>Account löschen</h3>
	</div>
	
		<div class="card-body container-fluid">
			<form action="function_delete_account.php" method="post">
				<div class="form-group">
					<label for="current_password">Aktuelles Passwort:</label>
					<input type="password" class="form-control" id="current_password" name="current_password" required>
				</div>
			<input type="submit" class="btn btn-primary" value="Bestätigen">
			</form>
			<br>
		</div>
	</div>
</div>
<?php
include_once "../Dreessen/footer.php";
?>
</body>
</html>
