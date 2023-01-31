<!--
Erstellt von Cem Cetin
Beschreibung: Verarbeitet die Daten aus dem Formular, um einen neuen Benutzer anzulegen
-->

<?php
// Verbindung zur Datenbank
require 'connect.php';

if (!isset($_POST['email']) || !isset($_POST['kennwort']) || !isset($_POST['kennwort2'])) {
    // Falls die Daten nicht aus dem Formular kommen, wird eine Fehlermeldung ausgegeben
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
$password2 = $_POST['kennwort2'];


// Überprüfen ob der User schon existiert
$query = 'SELECT * FROM users WHERE (email = :email)';
$isUserDubplicate = $dbh->prepare($query);
$isUserDubplicate->bindValue(':email', $email);
$isUserDubplicate->execute();
$countUser = $isUserDubplicate->rowCount();

if ($countUser > 0) {
    // Fehlermeldung ausgeben 
    ?>
    <script>
        alert("User bereits vorhanden!");
        window.location.href = "page_register.php";
    </script>
    <?php
    // Script beenden
    return;
}

    
// Überprüfen, ob die Passwörter übereinstimmen
$isPasswordCorrect = $password == $password2;
    if(!$isPasswordCorrect) { 
        //Passwort stimmt nicht überein ?>
        <script>
        alert("Kennwörter stimmen nicht überein!");
        window.location.href = "page_register.php";
        </script>
        <?php
        return;
    }

//Passwort stimmt überein
//Passwort hashen
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Daten in die Datenbank schreiben
$sql = "INSERT INTO users (email, passwort, roles_id) VALUES (:email, :passwordHash, :roles_id)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':passwordHash', $passwordHash);
$stmt->bindValue(':roles_id', 2);
$success = $stmt->execute();
// Falls die Daten erfolgreich in die Datenbank geschrieben wurden, ist $succed true
    if (!$success) {
        // Falls die Daten nicht in die Datenbank geschrieben wurden, wird eine Fehlermeldung ausgegeben
        echo "Error: " . $sql . "<br>" . $dbh->errorInfo();
        return;
    } 
// Falls die Daten erfolgreich in die Datenbank geschrieben wurden, wird eine Erfolgsmeldung ausgegeben
?>
<script>
alert("Erfolgreich registriert!");
window.location.href = "page_login.php";
</script>   

