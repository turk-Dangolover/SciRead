<html>
    <body>
        <?php
        $varauthor = $_POST['author'];
        $vartitel = $_POST['titel'];
        $varpages = $_POST['seitenzahl'];
        $verlag = $_POST['verlag'];
        $vardescription = $_POST['Kommentar'];
        $varpublished = $_POST['veroeffentlichungdatum'];
        $typ = $_POST['typ']; 
        $fachbereich = $_POST['fachbereich'];
        require_once 'Server_connect.php';
        
        //Fachbereich mit seiner jeweils angegebenen ID vergleichen und ID wiedergeben
       
        $stmt = $dbConnection->prepare("SELECT fachbereich_id FROM fachbereich WHERE fachbereich = ?");
        $stmt->execute([$fachbereich]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $varfachbereichid =$id['fachbereich_id'];
        //Neue IDs erstellen für verlag und typ
        $stmt = $dbConnection->prepare("SELECT publisher_id FROM publisher WHERE name = ?");
        $stmt->execute([$verlag]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $varverlagid =$id['publisher_id'];
        //TypID Herausgeben
        $stmt = $dbConnection->prepare("SELECT type_id FROM type WHERE type = ?");
        $stmt->execute([$typ]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $vartypid =$id['type_id'];
        //alles zusammengelegt
        $newId = (executeSQL("SELECT max(id) FROM books")->fetch())[0]+1;
        $insertLine = "INSERT INTO literature(literature_id, pages, author, title, published_date, comment, fachbereich_id, type_id, publisher_id, creation_date)
        VALUES ($newId,'$varpages','$varauthor','$vartitel','$varpublished','$vardescription', '$varfachbereichid','$vartypid','$varverlagid','current_timestamp');";
        executeSQL($insertLine);
        echo "Literature saved!";
		?>
    </body>
</html>