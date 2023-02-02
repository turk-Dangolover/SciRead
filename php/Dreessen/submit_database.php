<?php include_once 'navbar.php';
$user_id = $_SESSION['user_id']
 ?>
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
        $fachbereichid = $_POST['fachbereich_id'];

        //Neue IDs erstellen für verlag und typ
        $stmt = $dbConnection->prepare("SELECT publisher_id FROM publisher WHERE name = ?");
        $stmt->execute([$verlag]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $varverlagid =$id['publisher_id'];
        $verlagid = $_POST['verlagid'];
        
        //TypID Herausgeben
        $stmt = $dbConnection->prepare("SELECT type_id FROM type WHERE type = ?");
        $stmt->execute([$typ]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $vartypid =$id['type_id'];
        $typeid = $_POST['type_id'];

        //alles zusammengelegt
        $newId = (executeSQL("SELECT max(literatur_id) FROM literatur")->fetch())[0]+1;
        $insertLine = "INSERT INTO literatur(literatur_id, pages, author, title, published_date, comment, fachbereich_id, type_id, publisher_id, user_id)
        VALUES ($newId,'$varpages','$varauthor','$vartitel','$varpublished','$vardescription', '$varfachbereichid','$vartypid','$varverlagid','$user_id');";
        executeSQL($insertLine);
        echo "<div class= container><div class=card-header><h3>Literatur gesichert <h3></div></div>";
		?>
    </body>
</html>