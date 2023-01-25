<html>
<body>
  <?php
        $varverlag= $_POST['verlagname'];
        $varanmerkung= $_POST['kommentar'];

        require_once 'connect-server.php';
        $newID= (executeSQL("SELECT max(id) FROM verlag")->fetch())[0]+1;
        $insertLine = "INSERT INTO verlag(id, verlagname, kommentar)
                VALUES ($newID, '$varverlag','$varanmerkung');";
        executeSQL($insertLine);
        header("Location: addVerlag.php")
        ?>

        </body>
        </html>
      