
<html>
<body>
  <?php
        $vartyp= $_POST['typ'];
        $varanmerkung= $_POST['kommentar'];

        require_once 'connect-server.php';
        $newID= (executeSQL("SELECT max(id) FROM typ")->fetch())[0]+1;
        $insertLine = "INSERT INTO typ(id, typ, kommentar)
                VALUES ($newID, '$vartyp','$varanmerkung');";
        executeSQL($insertLine);
        header("Location: addType.php")
        ?>

        </body>
        </html>
      
      