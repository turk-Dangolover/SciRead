<!--
Erstellt von Cem Cetin
Beschreibung: Zum Löschen eines Accounts oder zum Löschen des eigenen Accounts
-->
<?php
// Verbindung zur Datenbank
require 'connect.php';
// Startet die Session
session_start();
// Falls der Benutzer nicht angemeldet ist, erscheint eine Fehlermeldung
if (!isset($_SESSION['user_id'])) {
    header('Location: page_delete_own_account.php');
}
$role = $_SESSION['roles_id'];

// Die Funktion wird vom Admin ausgeführt, wenn er einen Account löschen möchte
if (($role == '1' || $role == '3')) {
    if (isset($_GET['id'])) {
        // Holt die ID des Benutzers aus der URL
        $id = $_GET['id'];

        $checkOwner = 'SELECT roles_id FROM users WHERE user_id = :user_id';
        try {
            $stmt = $dbh->prepare($checkOwner);
            $stmt->bindValue(':user_id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $UserRoleOwner = $row['roles_id'];
            } catch (PDOException $e) {
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            die();
        }
        if($UserRoleOwner == 3){
                header('Location: page_admin_accounts.php');
                return;
            }
        $changesql = 'UPDATE literatur SET user_id = :filler WHERE user_id = :userE_id';
        try {
            $stmt = $dbh->prepare($changesql);
            $stmt->bindValue(':filler', NULL);
            $stmt->bindValue(':userE_id', $id);
            $stmt->execute();
            } catch (PDOException $e) {
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            die();
        }


      
        $changesql2 = 'DELETE FROM bookmark WHERE user_id = :userE_id';
        try {
            $stmt = $dbh->prepare($changesql2);
            $stmt->bindValue(':filler', NULL);
            $stmt->bindValue(':userE_id', $id);
            $stmt->execute();
            } catch (PDOException $e) {
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            die();
        }

        $query = 'DELETE FROM users WHERE user_id = :user_id';
        // Führt die Query aus
        try {
            $stmt = $dbh->prepare($query);
            $stmt->bindValue(':user_id', $id);
            $stmt->execute();
            header('Location: page_admin_accounts.php');
        } catch (PDOException $e) {
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            die();
        }
    }}
    
// Die Funktion wird vom Benutzer ausgeführt, wenn er seinen eigenen Account löschen möchte
if ($role == '2') {
        // Fängt die Daten aus dem Formular ab
        $passwort_aktuell = $_POST['current_password'];
        $user_id = $_SESSION['user_id'];

        $changesql = 'UPDATE literatur SET user_id = :filler WHERE user_id = :userE_id';
        try {
            $stmt = $dbh->prepare($changesql);
            $stmt->bindValue(':filler', NULL);
            $stmt->bindValue(':userE_id', $id);
            $stmt->execute();
            } catch (PDOException $e) {
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            die();
        }

        $changesql2 = 'UPDATE bookmark SET user_id = :filler WHERE user_id = :userE_id';
        try {
            $stmt = $dbh->prepare($changesql2);
            $stmt->bindValue(':filler', NULL);
            $stmt->bindValue(':userE_id', $id);
            $stmt->execute();
            } catch (PDOException $e) {
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            die();
        }

    // Holt das Passwort des Benutzers aus der Datenbank
    try{
        $stmt = $dbh->prepare("SELECT passwort FROM users WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $verify = password_verify($passwort_aktuell, $row['passwort']);}
    catch(PDOException $e){
        echo "Verbindung fehlgeschlagen: " . $e->getMessage();
        die();
}
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
        $query = 'DELETE FROM users WHERE user_id = :user_id';
        try{
            $stmt = $dbh->prepare($query);
            $stmt->bindValue(':user_id', $id);
            $stmt->execute();
        } catch (PDOException $e){
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
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
