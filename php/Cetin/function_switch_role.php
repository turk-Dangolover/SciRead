<!--
Erstellt von Cem Cetin
Beschreibung: Zum Wechseln der Rolle
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
if ($role == '3') {
    if (isset($_GET['id'])) {
        // Holt die ID des Benutzers aus der URL
        $id = $_GET['id'];

        $query = 'UPDATE users SET roles_id = :newRole WHERE user_id = :user_id';
        $isAdmin = 'SELECT roles_id FROM users WHERE user_id = :user_id';
        // Führt die Query aus
        try {
            //Guckt ob der Benutzer ein Admin ist
            $stmt = $dbh->prepare($isAdmin);
            $stmt->bindValue(':user_id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $UserRole = $row['roles_id'];
            if($UserRole == 3){
                header('Location: page_admin_accounts.php');
                return;
            }
            $stmt = $dbh->prepare($query);
            //Falls der Benutzer ein Admin ist, wird er zu einem User
            if($UserRole == 1){
                $stmt->bindValue(':newRole', 2);
            }
            //Falls der Benutzer ein User ist, wird er zu einem Admin
            else if($UserRole == 2){
                $stmt->bindValue(':newRole', 1);
            }
            $stmt->bindValue(':user_id', $id);
            $stmt->execute();
            header('Location: page_admin_accounts.php');
        } catch (PDOException $e) {
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            die();
        }
    }}