<html>
<body>
  <?php
        $varverlag= $_POST['name'];
        $varanmerkung= $_POST['comment'];

        require_once 'connect-server.php';
        $newID= (executeSQL("SELECT max(publisher_id) FROM publisher")->fetch())[0]+1;
        $insertLine = "INSERT INTO publisher(publisher_id, name, comment)
                VALUES ($newID, '$varverlag','$varanmerkung');";
        executeSQL($insertLine);
        header("Location: addVerlag.php")
        ?>

        </body>
        </html>
      