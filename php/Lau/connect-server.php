<?php 
$conn = parse_ini_file("../Lau/database.ini");
$host = $conn['host'];
$port = $conn['port'];
$db = $conn['database'];
$user = $conn['user'];
$pw = $conn['password'];
	
    $connStr = "pgsql:host=$host;port=$port;dbname=$db;";
    $dbConnection = new PDO ($connStr, $user, $pw);
    function executeSQL($query, $params = array()) {
        global $dbConnection;
        $stmt = $dbConnection->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    ?>