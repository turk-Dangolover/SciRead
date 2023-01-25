<?php 
$host="localhost";
$port=5432;
$db="literature";
$user="postgres";
$pw="asdf673fg";
	
    $connStr = "pgsql:host=$host;port=$port;dbname=$db;";
    $dbConnection = new PDO ($connStr, $user, $pw);
    function executeSQL($query, $params = array()) {
        global $dbConnection;
        $stmt = $dbConnection->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    ?>