<!--
Erstellt von Cem Cetin
Beschreibung: Verarbeitet die Daten aus dem Formular, vergleicht sie mit den Daten in der Datenbank und loggt den Benutzer ein
-->

<?php
// Verbindung zur Datenbank
require 'connect.php';

// Überprüfen ob das Formular leer ist
if(empty($_POST)){
    // Formular war leer
    ?>
    <script>
    window.location.href = "page_register.php";
    </script>
    <?php
    return;
    }

// Daten vom Formular erhalten
$email = $_POST['email'];
$password = $_POST['kennwort'];

// Nach Anmeldedaten in der Datenbank suchen
$query = 'SELECT * FROM users WHERE (email = :email)';
// Fehler abfangen falls ein Fehler auftritt
try
{
// Query ausführen
$stmt = $dbh->prepare($query);
$stmt->bindValue(':email', $email);
$stmt->execute();
}
// Fehler abfangen
catch (PDOException $e)
{
// Fehlermeldung ausgeben 
echo "Verbindung fehlgeschlagen: " . $e->getMessage();
// Script beenden
die();
}
// fetch(PDO::FETCH_ASSOC) liefert ein Array mit Spaltennamen als Schlüssel zurück.
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// Prüft ob ein Array zurückgegeben wurde
$isArray = is_array($row);
if (!$isArray)
{
    // Kein Array zurückgegeben, Benutzer existiert nicht.
    ?>
    <script>
        // Aus Sicherheitsgründen wir nur eine allgemeine Fehlermeldung ausgegeben
    alert("Anmeldedaten falsch!");
        window.location.href = "page_login.php";
    </script>
    <?php
    return;
}
// Überprüft ob das Passwort mit dem Passwort in der Datenbank übereinstimmt
$isPasswordCorrect = password_verify($password, $row['passwort']);
if (!$isPasswordCorrect)
{
    // Password ist falsch.
    ?>
    <script>
        // Aus Sicherheitsgründen wir nur eine allgemeine Fehlermeldung ausgegeben
    alert("Anmeldedaten falsch!");
        window.location.href = "page_login.php";
    </script>
    <?php
    return;
}
// Passwort ist richtig.
// Session starten und Variablen setzen.
session_start();
$_SESSION['email'] = $email;
$_SESSION['passwort'] = $password;
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['roles_id'] = $row['roles_id'];
$_SESSION['login'] = TRUE;
// Weiterleiten auf die Startseite.
header('Location: ../Dreessen/Homepage.php');
?>
