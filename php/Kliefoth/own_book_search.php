<!DOCTYPE html>
<html lang="de">
<!--Autor: Jonas Kliefoth -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suche</title>
</head>

<body>

    <?php
    include_once "../Dressen/navbar.php";
    require_once "../Dressen/Server_connect.php";
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location.href='page_login.php'</script>";
    }
    $user_id = $_SESSION['user_id'];
    if (isset($_GET['use'])) {
        $use = $_GET['use'];
    } else {
        $use = "";
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (isset($_GET['agreed'])) {
        $agreed = $_GET['agreed'];
    }
    if (isset($_POST['agreed'])) {
        $agreed = $_POST['agreed'];
    }
    if (isset($_POST['titel'])) {
        $titel = $_POST['titel'];
    } else {
        $titel = "";
    }
    if (isset($_POST['title'])) {
        $title = $_POST['title'];
    }
    if (isset($_POST['verlagid'])) {
        $verlagid = $_POST['verlagid'];
    }
    if (isset($_POST['seitenzahl'])) {
        $seitenzahl = $_POST['seitenzahl'];
    }
    if (isset($_POST['typid'])) {
        $typid = $_POST['typid'];
    }
    if (isset($_POST['author'])) {
        $author = $_POST['author'];
    }
    if (isset($_POST['veröffentlichungsdatum'])) {
        $veröffentlichungsdatum = $_POST['veröffentlichungsdatum'];
    }
    if (isset($_POST['fachbereichid'])) {
        $fachbereichid = $_POST['fachbereichid'];
    }
    if (isset($_POST['search-filter'])) {
        $sort = "ORDER BY " . $_POST['search-filter'];
    } else {
        $sort = "ORDER BY Titel ASC";
    }

    $books = executeSQL("SELECT book.id,Titel,VerlagID,Seitenzahl,TypID,Author,Veröffentlichungsdatum,FachbereichID FROM public.\"bookmark\" book JOIN public.\"wissenschaftliche_literatur\" wili On book.book_id = wili.id WHERE Titel LIKE '$titel%' AND userID = '$user_id' $sort")->fetchAll();

    if ($use === "delete" && isset($id)) {
        if (!isset($agreed)) {
            $book = executeSQL("SELECT Titel,VerlagID,Seitenzahl,TypID,Author,Veröffentlichungsdatum,FachbereichID,userID FROM public.\"bookmark\" book JOIN public.\"wissenschaftliche_literatur\" wili  On book.book_id = wili.id WHERE id='$id'")->fetch();
            if (isset($user_id)) {
                if ($user_id === $book[7]) {
    ?>
                    <div class="container">
                        <div class="row align-items-center ms-5 me-5 mt-5 border-top">
                            <p class="col pt-3 pb-3 mb-0 text-center">Wollen Sie wirklich das Buch von der Merkliste entfernen?</p>
                        </div>
                        <div class="row ms-5 me-5">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo "<tr>";
                                    echo "<td>" . $book[0] . "</td>";
                                    echo "<td>" . $book[1] . "</td>";
                                    echo "<td>" . $book[2] . "</td>";
                                    echo "<td>" . $book[3] . "</td>";
                                    echo "<td>" . $book[4] . "</td>";
                                    echo "<td>" . $book[5] . "</td>";
                                    echo "<td>" . $book[6] . "</td>";
                                    echo "</tr>";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row ms-5 me-5 justify-content-evenly">
                            <a href="user_book_search.php" class="col-4 btn btn-primary">←Zurück </a>
                            <a class="col-4 btn btn-danger" href="user_book_search.php?use=delete&id=<?php echo $id ?>&agreed=1">Entfernen?</a>
                        </div>
                    </div>
        <?php
                } else {
                    header("Location: search.php", true, 302);
                }
            } else {
                header("Location: search.php", true, 302);
            }
        } else {
            $book_userid = executeSQL("Select userID FROM public.\"wissenschaftliche_literatur\" WHERE id='$id'")->fetch()[0];
            if (isset($user_id)) {
                if ($user_id === $book_userid) {
                    executeSQL('DELETE FROM public."bookmark" WHERE book_id=' . $id . ' AND user_id=' . $user_id)->fetch();
                }
            }
            echo "<script>window.location.href='user_book_search.php'</script>";
        }
    } else {
        ?>
        <!-- #region Search Settings-->
        <div class="container">
            <form action="user_book_search.php" method="post" class="ms-5 me-5 mt-4 border-top">
                <div class="mb-3  row align-items-end">
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
            <!-- #endregion -->
            <!-- #region Listing of all Fitting books-->
            <div class="ms-5 me-5">
                <?php if (count($books) > 0) { ?>
                    <table class="table align-items-center">
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
                            foreach ($books as $b) {
                                foreach ($b as $row) {
                                }
                                echo "<tr>";
                                echo "<td>" . $b[1] . "</td>";
                                echo "<td>" . $b[2] . "</td>";
                                echo "<td>" . $b[3] . "</td>";
                                echo "<td>" . $b[4] . "</td>";
                                echo "<td>" . $b[5] . "</td>";
                                echo "<td>" . $b[6] . "</td>";
                                echo "<td>" . $b[7] . "</td>";
                                echo "<td><a href='user_book_search.php?use=delete&id=$b[0]' class='btn btn-danger'>Löschen</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
            </div>
            <!-- #endregion -->
        <?php } else { ?>
            <!-- #region Error if none found-->
            <p> Keine Einträge gefunden </p>
        <?php } ?>
        <!-- #endregion -->
    <?php } ?>
        </div>

</body>

</html>