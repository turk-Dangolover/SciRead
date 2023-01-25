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
       
        $stmt = $dbConnection->prepare("SELECT fachbereichid FROM fachbereich WHERE fachbereich = ?");
        $stmt->execute([$fachbereich]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $varfachbereichid =$id['fachbereichid'];
        //Neue IDs erstellen für verlag und typ
        $stmt = $dbConnection->prepare("SELECT verlagid FROM verlag WHERE name = ?");
        $stmt->execute([$verlag]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $varverlagid =$id['verlagid'];
        //TypID Herausgeben
        $stmt = $dbConnection->prepare("SELECT typid FROM typ WHERE typ = ?");
        $stmt->execute([$typ]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $vartypid =$id['typid'];
        //alles zusammengelegt
        $newId = (executeSQL("SELECT max(id) FROM books")->fetch())[0]+1;
        $insertLine = "INSERT INTO books(id, seitenzahl, author, titel, veröffentlichungsdatum, kommentar, fachbereichid, typid, verlagid)
        VALUES ($newId,'$varpages','$varauthor','$vartitel','$varpublished','$vardescription', '$varfachbereichid','$vartypid','$varverlagid');";
        executeSQL($insertLine);
        echo "Literature saved!";
		?>
    </body>
</html>