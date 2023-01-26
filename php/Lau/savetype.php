
<html>
<body>
  <?php
        $vartyp= $_POST['type'];
        $varanmerkung= $_POST['comment'];

        require_once 'connect-server.php';
        $newID= (executeSQL("SELECT max(type_id) FROM type")->fetch())[0]+1;
        $insertLine = "INSERT INTO type(type_id, type, comment)
                VALUES ($newID, '$vartyp','$varanmerkung');";
        executeSQL($insertLine);
        header("Location: addType.php")
        ?>

        </body>
        </html>
      
      