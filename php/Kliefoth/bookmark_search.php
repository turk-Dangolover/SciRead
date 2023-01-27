<!DOCTYPE html>
<html lang="de">
<!--Autor: Jonas Kliefoth -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SciRead | Merkliste</title>
</head>

<body>

    <?php
    include_once "../Dreessen/navbar.php";
    require_once "../Dreessen/Server_connect.php";
    //Überprüft ob der Nutzer angemeldet ist
    if (!isset($_SESSION['user_id'])) {
        include_once('../Cetin/401.php');
        //Falls man nicht angemeldet ist bekommt der Nutzer eine 401 Sprich eine "Nicht Autorisiert" Seite angezeigt
        return;
    }
    $user_id = $_SESSION['user_id'];
    if (isset($_GET['use'])) {
        $use = $_GET['use'];
    } else {
        $use = "";
    }
    //Diese Variable wird für die Update/Löschen Funktion benutzt
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    //Diese Variable wird für die Löschen Funktion benutzt
    if (isset($_GET['agreed'])) {
        $agreed = $_GET['agreed'];
    }
    //Diese Variable wird für die Update Funktion benutzt
    if (isset($_POST['agreed'])) {
        $agreed = $_POST['agreed'];
    }
    //Diese Variablen werden für die Update Funktion benutzt
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

    //Diese Variablen werden von der Suche benutzt
    if (isset($_POST['titel'])) {
        $titel = $_POST['titel'];
    } else {
        $titel = "";
    }
    if (isset($_POST['search-filter'])) {
        $sort = "ORDER BY " . $_POST['search-filter'];
    } else {
        $sort = "ORDER BY Title ASC";
    }

    $books = executeSQL("SELECT book.literatur_id,title,pub.name,pages,ty.type,author,published_date,fb.fachbereich FROM public.\"bookmark\" book JOIN public.\"literatur\" lit  USING (literatur_id) JOIN fachbereich fb USING (fachbereich_id) JOIN publisher pub USING (publisher_id) JOIN type ty USING (type_id) WHERE title LIKE '$titel%' AND book.user_id = '$user_id' $sort")->fetchAll();

    if ($use === "delete" && isset($id)) {
        if (!isset($agreed)) {
            $book = executeSQL("SELECT title,pub.name,pages,ty.type,author,published_date,fb.fachbereich,book.user_id FROM public.\"bookmark\" book JOIN public.\"literatur\" lit  USING (literatur_id) JOIN fachbereich fb USING (fachbereich_id) JOIN publisher pub USING (publisher_id) JOIN type ty USING (type_id) WHERE literatur_id='$id'")->fetch();
            if (isset($user_id)) {
                if ($user_id === $book[7]) {
    ?>
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3>Merkliste</h3>
                            </div>
                            <div class="card-body  container-fluid">
                                <div class="row align-items-center ms-5 me-5 mt-5 border-top">
                                    <p class="col pt-3 pb-3 mb-0 text-center">Wollen Sie wirklich das Buch von der Merkliste entfernen?</p>
                                </div>
                                <div class="row ms-5 me-5 text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Titel</th>
                                                <th scope="col">Verlag</th>
                                                <th scope="col">Seitenanzahl</th>
                                                <th scope="col">Typ</th>
                                                <th scope="col">Autor</th>
                                                <th scope="col">Veröffentlichungsdatum</th>
                                                <th scope="col">Fachbereich</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            echo "<tr>";
                                            echo "<td>" . $book[0] . "</td>"; //Titel
                                            echo "<td>" . $book[1] . "</td>"; //Verlag
                                            echo "<td>" . $book[2] . "</td>"; //Seitenanzahl
                                            echo "<td>" . $book[3] . "</td>"; //TypID
                                            echo "<td>" . $book[4] . "</td>"; //Autor
                                            echo "<td>" . $book[5] . "</td>"; //Veröffentlichungsdatum
                                            echo "<td>" . $book[6] . "</td>"; //FachbereichID
                                            echo "</tr>";
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row ms-5 me-5 justify-content-evenly">
                                    <a href="bookmark_search.php" class="col-4 btn btn-primary">←Zurück </a>
                                    <a class="col-4 btn btn-danger" href="bookmark_search.php?use=delete&id=<?php echo $id ?>&agreed=1">Entfernen?</a>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
                } else {
                    echo "<script>window.location.href='bookmark_search.php'</script>";
                }
            } else {
                echo "<script>window.location.href='bookmark_search.php'</script>";
            }
        } else {
            $book_userid = executeSQL("SELECT user_id FROM public.bookmark WHERE literatur_id='$id'")->fetch()[0];
            if (isset($user_id)) {
                if ($user_id === $book_userid) {
                    executeSQL('DELETE FROM public.bookmark WHERE literatur_id=' . $id . ' AND user_id=' . $user_id)->fetch();
                }
            }
            echo "<script>window.location.href='bookmark_search.php'</script>";
        }
    } else {
        ?>
        <!-- #region Search Settings-->
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Merkliste</h3>
                </div>
                <div class="card-body container-fluid">
                    <form action="bookmark_search.php" method="post" class="ms-5 me-5 mt-4 border-top">
                        <div class="mb-3  row align-items-end">
                            <div class="col-auto">
                                <label for="titel" class=" col-form-label">Suche:</label>
                                <input class="form-control" type="search" name="titel" id="titel" placeholder="Titel eingeben" value="<?php echo $titel ?>" autocomplete="off">
                            </div>
                            <div class="col-auto">
                                <label for="search-filter" class="col-form-label">Sortieren:</label>
                                <select class="form-control" name="search-filter" id="search-filter">
                                    <option value="title ASC" <?php if ($sort === "ORDER BY title ASC") echo "selected" ?>>Titel ↓</option>
                                    <option value="title DESC" <?php if ($sort === "ORDER BY title DESC") echo "selected" ?>>Titel ↑</option>
                                    <option value="author ASC" <?php if ($sort === "ORDER BY author ASC") echo "selected" ?>>Autor ↓</option>
                                    <option value="author DESC" <?php if ($sort === "ORDER BY author DESC") echo "selected" ?>>Autor ↑</option>
                                    <option value="pages ASC" <?php if ($sort === "ORDER BY pages ASC") echo "selected" ?>>Seitenanzahl ↓</option>
                                    <option value="pages DESC" <?php if ($sort === "ORDER BY pages DESC") echo "selected" ?>>Seitenanzahl ↑</option>
                                    <option value="published_date ASC" <?php if ($sort === "ORDER BY published_date ASC") echo "selected" ?>>Veröffentlichungsdatum ↓</option>
                                    <option value="published_date DESC" <?php if ($sort === "ORDER BY published_date DESC") echo "selected" ?>>Veröffentlichungsdatum ↑</option>
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
                                        <th scope="col">Verlag</th>
                                        <th scope="col">Seitenanzahl</th>
                                        <th scope="col">Typ</th>
                                        <th scope="col">Autor</th>
                                        <th scope="col">Veröffentlichungsdatum</th>
                                        <th scope="col">Fachbereich</th>
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
                                        echo "<td><a href='bookmark_search.php?use=delete&id=$b[0]' class='btn btn-danger'>Löschen</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    <!-- #endregion -->
                <?php } else { ?>
                    <!-- #region Error if none found-->
                    <p> Keine Einträge gefunden! <a href="search.php">Zurück zur Suche ?</a></p>
                <?php } ?>
                <!-- #endregion -->
            <?php } ?>
                </div>
            </div>
        </div>
        <?php include "../Dreessen/footer.php" ?>

</body>

</html>