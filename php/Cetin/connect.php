<?php
//Erstellt von Cem Cetin
//Datum: 02.01.2023
//Beschreibung: Verbindung zur Datenbank
?>

<?php
$config = parse_ini_file("../../database.ini");
$host = $config['host'];
$port = $config['port'];
$db = $config['database'];
$user = $config['user'];
$pw = $config['password'];
$cStr = "pgsql:host=$host; port=$port;dbname=$db;";
try {
    $dbh = new PDO($cStr, $user, $pw);

    $countAdmin = $dbh->prepare("SELECT email FROM users WHERE email = 'admin@admin.de'");
    $countAdmin->execute();
    $count = $countAdmin->fetchColumn();
    if($count < 1){
        $pw = password_hash('admin', PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, passwort, roles_id) VALUES (:email, :passwort, :roles_id)";
        $stmt = $dbh->prepare($sql);
         $stmt->bindValue(':email', 'admin@admin.de');
         $stmt->bindValue(':passwort', $pw);
         $stmt->bindValue(':roles_id', 1);
        $stmt->execute();
    }
    
} catch (PDOException $e) {
    echo "Verbindung fehlgeschlagen: " . $e->getMessage();
}
?>