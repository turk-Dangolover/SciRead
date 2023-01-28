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
        // Führt die Query aus
        try {
            $stmt = $dbh->prepare($query);
            $stmt->bindValue(':newRole', 1);
            $stmt->bindValue(':user_id', $id);
            $stmt->execute();
            header('Location: page_admin_accounts.php');
        } catch (PDOException $e) {
           echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            die();
        }
    }}