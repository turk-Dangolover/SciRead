<?php
//Erstellt von Cem Cetin
//Beschreibung: Verbindung zur Datenbank
?>

<?php
$config = parse_ini_file("../../database.ini");
$host = $config['host'];
$port = $config['port'];
$db = $config['database'];
$user = $config['user'];
$pw = $config['password'];
//Verbindung zur Datenbank wird hergestellt
$cStr = "pgsql:host=$host; port=$port;dbname=$db;";
//Try Catch-Block, um Fehler abzufangen
try {
    //Objekt wird erstellt
    $dbh = new PDO($cStr, $user, $pw);
    //Admin wird erstellt, wenn noch nicht vorhanden
    $sqlSelect = "SELECT email FROM users WHERE email = :email";
    $stmtSelect = $dbh->prepare($sqlSelect);
    $stmtSelect->bindValue(':email', 'admin@admin.de');
    $stmtSelect->execute();
    $count = $stmtSelect->rowCount();
    if($count < 1){
        $pwAdmin = password_hash('admin', PASSWORD_DEFAULT);
        //Es werden Parameter verwendet, um SQL-Injection zu verhindern
        $sql = "INSERT INTO users (email, passwort, roles_id) VALUES (:email, :passwort, :roles_id)";
        $stmt = $dbh->prepare($sql);
         $stmt->bindValue(':email', 'admin@admin.de');
         $stmt->bindValue(':passwort', $pwAdmin);
         $stmt->bindValue(':roles_id', 3);
        $stmt->execute();
    }
    
} catch (PDOException $e) {
    echo "Verbindung fehlgeschlagen: " . $e->getMessage();
}
?>