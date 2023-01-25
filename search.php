<!DOCTYPE html>
<html lang="de">
<!--Autor: Jonas Kliefoth-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suche</title>
</head>

<body>
    <?php
    include_once "navbar.php";
    require_once "Server_connect.php";
    if (isset($_POST['titel']) || isset($_GET['titel'])) {
        if (isset($_POST['titel'])) {
            $titel = $_POST['titel'];
        } else {
            $titel = $_GET['titel'];
        }
    } else {
        $titel = "";
    }
    if (isset($_POST['search-filter'])) {
        $sort = "ORDER BY " . $_POST['search-filter'];
    } else {
        $sort = "ORDER BY Titel ASC";
    }
    $books = executeSQL("SELECT Titel,VerlagID,Seitenzahl,TypID,Author,Veröffentlichungsdatum,FachbereichID,id FROM public.\"wissenschaftliche_literatur\" WHERE Titel LIKE '$titel%' $sort")->fetchAll();
    if (isset($_GET['use'])) {
        $use = $_GET['use'];
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if ($use === "addbookmark")
    ?>
    <div class="container">
        <form action="search.php" method="post" class="ms-5 me-5 border-top">
            <div class="mb-3 mt-3 row align-items-end">
                <div class="col-auto">
                    <label for="titel" class=" col-form-label">Suche:</label>
                    <input class="form-control" type="search" name="titel" id="titel" placeholder="Titel eingeben" value="<?php echo $titel ?>" autocomplete="off">
                </div>
                <div class="col-auto">
                    <label for="search-filter" class="col-form-label">Sortieren:</label>
                    <select class="form-select" name="search-filter" id="search-filter">
                        <option value="Titel ASC" <?php if ($sort === "ORDER BY Titel ASC") echo "selected" ?>>Titel ↓</option>
                        <option value="Titel DESC" <?php if ($sort === "ORDER BY Titel DESC") echo "selected" ?>>Titel ↑</option>
                        <option value="Author ASC" <?php if ($sort === "ORDER BY Author ASC") echo "selected" ?>>Autor ↓</option>
                        <option value="Author DESC" <?php if ($sort === "ORDER BY Author DESC") echo "selected" ?>>Autor ↑</option>
                        <option value="Seitenzahl ASC" <?php if ($sort === "ORDER BY Seitenzahl ASC") echo "selected" ?>>Seitenanzahl ↓</option>
                        <option value="Seitenzahl DESC" <?php if ($sort === "ORDER BY Seitenzahl DESC") echo "selected" ?>>Seitenanzahl ↑</option>
                        <option value="Veröffentlichungsdatum ASC" <?php if ($sort === "ORDER BY Veröffentlichungsdatum ASC") echo "selected" ?>>Veröffentlichungsdatum ↓</option>
                        <option value="Veröffentlichungsdatum DESC" <?php if ($sort === "ORDER BY Veröffentlichungsdatum DESC") echo "selected" ?>>Veröffentlichungsdatum ↑</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Abschicken</button>
                </div>
            </div>
        </form>
        <div class="ms-5 me-5">
            <?php if (count($books) > 0) { ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Titel</th>
                            <th scope="col">VerlagID</th>
                            <th scope="col">Seitenanzahl</th>
                            <th scope="col">TypID</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Veröffentlichungsdatum</th>
                            <th scope="col">FachbereichID</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        foreach ($books as $b) {
                            $bookmark = executeSQL("SELECT book_id FROM public.\"bookmark\" WHERE book_id = $b[7] and user_id = $user_id")->fetchAll();
                            echo "<tr>";
                            echo "<td>" . $b[0] . "</td>";
                            echo "<td>" . $b[1] . "</td>";
                            echo "<td>" . $b[2] . "</td>";
                            echo "<td>" . $b[3] . "</td>";
                            echo "<td>" . $b[4] . "</td>";
                            echo "<td>" . $b[5] . "</td>";
                            echo "<td>" . $b[6] . "</td>";
                            if ($bookmark == null) {
                                echo "<td><a class='btn' href='search.php?use=addbookmark?id=$b[7]'>+</a></td>";
                            } else {
                                echo "<td><a class='btn' href='search.php?use=removebookmark?id=$b[7]'>-</a></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p> Keine Einträge gefunden </p>
            <?php } ?>
        </div>
    </div>
</body>

</html>