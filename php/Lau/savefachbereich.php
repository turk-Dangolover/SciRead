<html>
<body>
  <?php
        $varfachbereich= $_POST['fachbereich'];
        $varanmerkung= $_POST['comment'];

        require_once 'connect-server.php';
        $newID= (executeSQL("SELECT max(fachbereich_id) FROM fachbereich")->fetch())[0]+1;
        $insertLine = "INSERT INTO fachbereich(fachbereich_id, fachbereich, comment)
                VALUES ($newID, '$varfachbereich','$varanmerkung');";
        executeSQL($insertLine);
        header("Location: addFachbereich.php")
        ?>

        </body>
        </html>