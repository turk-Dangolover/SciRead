<!DOCTYPE html>
<html lang="de">
<!--Autor: Jonas Kliefoth -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SciRead | Suche</title>
</head>

<body>

    <?php
    include_once "../Dreessen/navbar.php";
    require_once "../Dreessen/Server_connect.php";
    if (!isset($_SESSION['user_id'])) {
        include_once('../Cetin/401.php');
        return;
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
        $sort = "ORDER BY Title ASC";
    }
    if (isset($user_id) && isset($_SESSION['roles_id'])) {
        if ($_SESSION['roles_id'] !== 2) {
            $books = executeSQL("SELECT lit.literatur_id,title,pub.name,pages,ty.type,author,published_date,fb.fachbereich,lit.user_id FROM public.\"literatur\" lit LEFT JOIN fachbereich fb USING (fachbereich_id) LEFT JOIN publisher pub USING (publisher_id) LEFT JOIN type ty USING (type_id) WHERE title LIKE '$titel%' $sort")->fetchAll();
        } else {
            $books = executeSQL("SELECT lit.literatur_id,title,pub.name,pages,ty.type,author,published_date,fb.fachbereich,lit.user_id FROM public.\"literatur\" lit LEFT JOIN fachbereich fb USING (fachbereich_id) LEFT JOIN publisher pub USING (publisher_id) LEFT JOIN  type ty USING (type_id) WHERE title LIKE '$titel%' AND lit.user_id = '$user_id' $sort")->fetchAll();
        }
    }


    if ($use === "delete" && isset($id)) {
        if (!isset($agreed)) {
            $book = executeSQL("SELECT title,pub.name,pages,ty.type,author,published_date,fb.fachbereich,lit.user_id FROM public.\"literatur\" lit  JOIN fachbereich fb USING (fachbereich_id) LEFT JOIN publisher pub USING (publisher_id) LEFT JOIN type ty USING (type_id) WHERE literatur_id='$id'")->fetch();
            if (isset($user_id)) {
                if ($user_id === $book[7] || $_SESSION['roles_id'] === 1  || $_SESSION['roles_id'] === 3) {
    ?>
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3>Suche</h3>
                            </div>
                            <div class="row align-items-center ms-5 me-5 mt-5 border-top">
                                <p class="col pt-3 pb-3 mb-0 text-center">Wollen Sie wirklich das Buch löschen?</p>
                            </div>
                            <div class="row ms-5 me-5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Titel</th>
                                            <th scope="col">Verlag</th>
                                            <th scope="col">Seitenanzahl</th>
                                            <th scope="col">TypID</th>
                                            <th scope="col">Autor</th>
                                            <th scope="col">Veröffentlichungsdatum</th>
                                            <th scope="col">Fachbereich</th>
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
                                <a class="col-4 btn btn-danger" href="user_book_search.php?use=delete&id=<?php echo $id ?>&agreed=1">Löschen?</a>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    echo "<script>window.location.href='user_book_search.php'</script>";
                }
            } else {
                echo "<script>window.location.href='user_book_search.php'</script>";
            }
        } else {
            $book_userid = executeSQL("SELECT user_id FROM public.\"literatur\" WHERE literatur_id='$id'")->fetch()[0];
            if (isset($user_id)) {
                if ($user_id === $book_userid || $_SESSION['roles_id'] === 1  || $_SESSION['roles_id'] === 3) {
                    $bookmark = executeSQL("SELECT bookmark_id FROM public.\"bookmark\" WHERE literatur_id='$id'")->fetchAll();
                    foreach ($bookmark as $b) {
                        executeSQL('DELETE FROM public."bookmark" WHERE bookmark_id=' . $b[0])->fetch();
                    }
                    executeSQL('DELETE FROM public."literatur" WHERE literatur_id=' . $id)->fetch();
                }
            }
            echo "<script>window.location.href='user_book_search.php'</script>";
        }
    } elseif ($use === "update"  && isset($id)) {
        if (!isset($agreed)) {
            $book = executeSQL("SELECT title,pub.publisher_id,pages,ty.type_id,author,published_date,fb.fachbereich_id,lit.user_id FROM public.\"literatur\" lit LEFT JOIN fachbereich fb USING (fachbereich_id) LEFT JOIN publisher pub USING (publisher_id) LEFT JOIN type ty USING (type_id) WHERE literatur_id='$id'")->fetch();
            if (isset($user_id)) {
                if ($user_id === $book[7] || $_SESSION['roles_id'] === 1  || $_SESSION['roles_id'] === 3) {
                ?>
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3>Suche</h3>
                            </div>
                            <div class="card-body text-center container-fluid">
                                <form action="user_book_search.php?use=update&id=<?php echo $id ?>&agreed=1" method="post" class="ms-5 me-5 mt-4 border-top">
                                    <div class="pt-3 mb-3 row">
                                        <div class="col">
                                            <label for="titel" class="col-form-label">Titel:</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Titel" value="<?php echo $book[0] ?>" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <label for="verlagid" class="col-form-label">Verlag:</label>
                                            <select class="form-control" id="verlagid" name='verlagid'>
                                                <?php
                                                $verlag = executeSQL("SELECT publisher_id,name FROM publisher")->fetchAll();
                                                foreach ($verlag as $v) {
                                                    if ($v[0] === $book[1]) {
                                                        echo "<option value='$v[0]' selected>$v[1]</option>";
                                                    } else {
                                                        echo "<option value='$v[0]'>$v[1]</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="seitenzahl" class="col-form-label">Seitenzahl:</label>
                                            <input type="text" class="form-control" name="seitenzahl" id="seitenzahl" placeholder="Seitenzahl" value="<?php echo $book[2] ?>" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <label for="typid" class="col-form-label">Typ:</label>
                                            <select class="form-control" id="typid" name='typid'>
                                                <?php
                                                $typ = executeSQL("SELECT type_id,type FROM type")->fetchAll();
                                                foreach ($typ as $t) {
                                                    if ($t[0] === $book[3]) {
                                                        echo "<option value='$t[0]' selected>$t[1]</option>";
                                                    } else {
                                                        echo "<option value='$t[0]'>$t[1]</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col">
                                            <label for="author" class="col-form-label">Autor:</label>
                                            <input type="text" class="form-control" name="author" id="author" placeholder="Autor" value="<?php echo $book[4] ?>" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <label for="veröffentlichungsdatum" class="col-form-label">Veröffentlichungsdatum:</label>
                                            <input type="text" class="form-control" name="veröffentlichungsdatum" id="veröffentlichungsdatum" placeholder="Veröffentlichungsdatum" value="<?php echo $book[5] ?>" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <label for="fachbereichid" class="col-form-label">Fachbereich:</label>
                                            <select class="form-control" name="fachbereichid" id="fachbereichid">
                                                <?php
                                                $fachbereich = executeSQL("SELECT fachbereich_id,fachbereich FROM fachbereich")->fetchAll();
                                                foreach ($fachbereich as $f) {
                                                    if ($f[0] === $book[6]) {
                                                        echo "<option value='$f[0]' selected>$f[1]</option>";
                                                    } else {
                                                        echo "<option value='$f[0]'>$f[1]</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 mt-3 row justify-content-center">
                                        <div class="col-auto">
                                            <a href="user_book_search.php" class="btn btn-primary">←Zurück </a>
                                            <button type="submit" class="btn btn-danger">Änderung Abschicken</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

        <?php
                } else {
                    echo "<script>window.location.href='user_book_search.php'</script>";
                }
            } else {
                echo "<script>window.location.href='user_book_search.php'</script>";
            }
        } else {
            $book_userid = executeSQL("SELECT user_id FROM public.\"literatur\" WHERE literatur_id='$id'")->fetch()[0];
            if (isset($user_id)) {
                if ($user_id === $book_userid || $_SESSION['roles_id'] === 1  || $_SESSION['roles_id'] === 3) {
                    executeSQL("UPDATE literatur SET title='" . $title . "',publisher_id='" . $verlagid . "',pages='" . $seitenzahl . "',type_id='" . $typid . "',author='" . $author . "',published_date='" . $veröffentlichungsdatum . "',fachbereich_id='" . $fachbereichid . "'  WHERE literatur_id=" . $id)->execute();
                }
            }
            echo "<script>window.location.href='user_book_search.php'</script>";
        }
    } else {
        ?>
        <!-- #region Search Settings-->
        <div class="container">

            <div class="card-header">
                <h3>Suche</h3>
            </div>
            <form action="user_book_search.php" method="post" class="ms-5 me-5 mt-4 border-top">
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
                                <th scope="col">TypID</th>
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
                                echo "<td><a href='user_book_search.php?use=update&id=$b[0]' class='btn btn-primary'>Bearbeiten</a>";
                                if ($_SESSION['roles_id'] === 1 || $_SESSION['roles_id'] === 3 || $user_id === $b[8]) {
                                    echo " <a href='user_book_search.php?use=delete&id=$b[0]' class='btn btn-danger'>Löschen</a></td>";
                                } else {
                                    echo "</td>";
                                }
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
        <?php include "../Dreessen/footer.php" ?>

</body>

</html>