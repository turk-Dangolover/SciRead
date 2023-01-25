<?php
//Erstellt von Cem Cetin
//Datum: 02.01.2023
//Beschreibung: Verbindung zur Datenbank
?>

<?php
$config = parse_ini_file("../../config.ini");
$host = $config['host'];
$port = $config['port'];
$db = $config['db'];
$user = $config['user'];
$pw = $config['pw'];
$cStr = "pgsql:host=$host; port=$port;dbname=$db;";
try {
    $dbh = new PDO($cStr, $user, $pw);
} catch (PDOException $e) {
    echo "Verbindung fehlgeschlagen: " . $e->getMessage();
}
?>