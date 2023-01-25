<html>
<body>
  <?php
        $varfachbereich= $_POST['fachbereich'];
        $varanmerkung= $_POST['kommentar'];

        require_once 'connect-server.php';
        $newID= (executeSQL("SELECT max(id) FROM fachbereich")->fetch())[0]+1;
        $insertLine = "INSERT INTO fachbereich(id, fachbereich, kommentar)
                VALUES ($newID, '$varfachbereich','$varanmerkung');";
        executeSQL($insertLine);
        header("Location: addFachbereich.php")
        ?>

        </body>
        </html>