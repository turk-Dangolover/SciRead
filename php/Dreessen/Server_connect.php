     <?php 
	    $params = parse_ini_file('database.ini');
        $host = $params['host'];
        $port = $params['port'];
        $db = $params['database'];
        $user = $params['user'];
        $pw = $params['password'];

	    $conStr="pgsql:host=$host;port=$port;dbname=$db;";
	    $dbConnection = new PDO( $conStr, $user, $pw );
        function executeSQL($query, $params = array()) {
            global $dbConnection;
            $stmt = $dbConnection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        }
    
    ?>