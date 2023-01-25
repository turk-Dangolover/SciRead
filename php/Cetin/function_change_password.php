<!--
Erstellt von Cem Cetin
Datum: 02.01.2023
Beschreibung: Verarbeitet die Daten aus dem Formular und ändert das Passwort des Benutzers
-->
<?php
// Verbindung zur Datenbank
require 'connect.php';
if(isset($_POST['submit'])){
// Fängt die Daten aus dem Formular ab
$passwort_aktuell = $_POST['current_password'];
$passwort_neu = $_POST['new_password'];
$passwort_confirm = $_POST['confirm_password'];

// Fängt die ID des Benutzers ab
session_start();
$user_id = $_SESSION['user_id'];

// Holt das Passwort des Benutzers aus der Datenbank
// PDO Statement Objekt wird erstellt
$stmt = $dbh->prepare("SELECT passwort FROM users WHERE user_id = :user_id");
// Parameter werden an das PDO Statement Objekt gebunden
$stmt->bindParam(':user_id', $user_id);
// PDO Statement wird ausgeführt
$stmt->execute();
// Das Ergebnis wird in eine Variable gespeichert
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Kontrolliert ob das aktuelle Passwort mit dem Passwort in der Datenbank übereinstimmt
$verify = password_verify($passwort_aktuell, $row['passwort']);
if (!$verify) { 
    // Falls das Passwort falsch ist, wird der Benutzer hierher weitergeleitet
    header('Location: page_change_password.php?success=2');
    return;
}
// Kontrolliert ob das neue Passwort mit dem Bestätigungspasswort übereinstimmt
$isPasswordCorrect = $passwort_neu == $passwort_confirm;
if (!$isPasswordCorrect) {
        // Falls Passwörter nicht übereinstimmen, wird der Benutzer hierher weitergeleitet
        header('Location: page_change_password.php?success=1');
        return;
    }

// Hasht das neue Passwort
$hashed_password = password_hash($passwort_neu, PASSWORD_DEFAULT);

// Updatet das Passwort in der Datenbank
$sql = "UPDATE users SET passwort = '$hashed_password' WHERE user_id = $user_id";
$stmt = $dbh->prepare($sql);
$stmt->execute();
// Falls erfolgreich, wird der Benutzer hierher weitergeleitet
header('Location: page_change_password.php?success=0');

// Schließt die Verbindung zur Datenbank
$dbh->connection = null;
}
header('Location: page_change_password.php?success=3');

?>