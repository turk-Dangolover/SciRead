
<!--
Erstellt von Cem Cetin
Datum: 05.01.2023
Beschreibung: Zum Löschen eines Accounts oder zum Löschen des eigenen Accounts
-->
<?php
// Verbindung zur Datenbank
require 'connect.php';
// Startet die Session
session_start();
$role = $_SESSION['roles_id'];
// Falls der Benutzer nicht angemeldet ist, erscheint eine Fehlermeldung
if($role == 'null'){
    header('Location: 401.php');
}
// Die Funktion wird vom Admin ausgeführt, wenn er einen Account löschen möchte
if ($role == '1') {
    if (isset($_GET['id'])) {
        // Holt die ID des Benutzers aus der URL
        $id = $_GET['id'];
        $query = 'DELETE FROM users WHERE user_id = :id';
        $daten = [':id' => $id];
        // Führt die Query aus
        try {
            $res = $dbh->prepare($query);
            $res->execute($daten);
            header('Location: page_admin_accounts.php');
        } catch (PDOException $e) {
            echo 'Query error.';
            die();
        }
    }}
    
// Die Funktion wird vom Benutzer ausgeführt, wenn er seinen eigenen Account löschen möchte
if ($role == '2') {
    // Fängt die Daten aus dem Formular ab
    $passwort_aktuell = $_POST['current_password'];
    $user_id = $_SESSION['user_id'];

    // Holt das Passwort des Benutzers aus der Datenbank
    $stmt = $dbh->prepare("SELECT passwort FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $verify = password_verify($passwort_aktuell, $row['passwort']);
    // Falls das Passwort falsch ist, erscheint eine Fehlermeldung
    if(!($verify)){
        ?>
        <script>
        alert("Passwort ist falsch!");
        window.location.href = "page_delete_own_account.php";
        </script>
        <?php
        return;
    }
    // Falls das Passwort richtig ist, wird der Account gelöscht
        $id = $_SESSION['user_id'];
        $query = 'DELETE FROM users WHERE user_id = :id';
        $daten = [':id' => $id];
        try {
            $res = $dbh->prepare($query);
            $res->execute($daten);
        } catch (PDOException $e) {
            echo 'Query error.';
            die();
        }
        // Die Session wird beendet
        session_destroy();
        ?>
        <script>
        alert("Account wurde gelöscht!");
        window.location.href = "page_login.php";
        </script>
        <?php
    }
?>
