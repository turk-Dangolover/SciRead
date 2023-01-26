<!--
Erstellt von Cem Cetin
Datum: 01.01.2023
Beschreibung: Verarbeitet die Daten aus dem Formular, um einen neuen Benutzer anzulegen
-->

<?php
// Verbindung zur Datenbank
require 'connect.php';

// Daten vom Formular erhalten
$email = $_POST['email'];
$password = $_POST['kennwort'];
$password2 = $_POST['kennwort2'];


// Überprüfen ob der User schon existiert
$query = 'SELECT * FROM users WHERE (email = :email)';
$isUserDubplicate = $dbh->prepare($query);
$isUserDubplicate->execute(['email' => $email]);
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
$sql = "INSERT INTO users (email, passwort, roles_id) VALUES ('$email', '$passwordHash', 2)";
// Falls die Daten erfolgreich in die Datenbank geschrieben wurden, ist exec() größer als 0 und es wird eine Erfolgsmeldung ausgegeben
$isDBConnectionSuccessful = $dbh->exec($sql) >0;
    if (!$isDBConnectionSuccessful) {
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
<?php
// Verbindung schließen
$dbh->connection = null;
?>
