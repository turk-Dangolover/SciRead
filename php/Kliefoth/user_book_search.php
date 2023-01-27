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
    include_once "../Dreessen/navbar.php";
    require_once "../Dreessen/Server_connect.php";
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location.href='../Cetin/page_login.php'</script>";
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

    $books = executeSQL("SELECT literatur_id,title,publisher_id,pages,type_id,author,published_date,fachbereich_id FROM public.\"literatur\" WHERE title LIKE '$titel%' AND user_id = '$user_id' $sort")->fetchAll();

    if ($use === "delete" && isset($id)) {
        if (!isset($agreed)) {
            $book = executeSQL("SELECT title,publisher_id,pages,type_id,author,published_date,fachbereich_id,user_id FROM public.\"literatur\" WHERE literatur_id='$id'")->fetch();
            if (isset($user_id)) {
                if ($user_id === $book[7]) {
    ?>
                    <div class="container">
                        <div class="row align-items-center ms-5 me-5 mt-5 border-top">
                            <p class="col pt-3 pb-3 mb-0 text-center">Wollen Sie wirklich das Buch löschen?</p>
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
                            <a class="col-4 btn btn-danger" href="user_book_search.php?use=delete&id=<?php echo $id ?>&agreed=1">Löschen?</a>
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
            $book_userid = executeSQL("SELECT user_id FROM public.\"literatur\" WHERE literatur_id='$id'")->fetch()[0];
            if (isset($user_id)) {
                if ($user_id === $book_userid) {
                    executeSQL('DELETE FROM public."literatur" WHERE literatur_id=' . $id)->fetch();
                }
            }
            echo "<script>window.location.href='user_book_search.php'</script>";
        }
    } elseif ($use === "update"  && isset($id)) {
        if (!isset($agreed)) {
            $book = executeSQL("Select title,publisher_id,pages,type_id,author,published_date,fachbereich_id,user_id FROM public.\"literatur\" WHERE literatur_id='$id'")->fetch();
            if (isset($user_id)) {
                if ($user_id === $book[7]) {
                ?>
                    <div class="container">
                        <form action="user_book_search.php?use=update&id=<?php echo $id ?>&agreed=1" method="post" class="ms-5 me-5 mt-4 border-top">
                            <div class="pt-3 mb-3 row">
                                <div class="col">
                                    <label for="titel" class="col-form-label">Titel:</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Titel" value="<?php echo $book[0] ?>" autocomplete="off">
                                </div>
                                <div class="col">
                                    <label for="verlagid" class="col-form-label">VerlagID:</label>
                                    <input type="text" class="form-control" name="verlagid" id="verlagid" placeholder="VerlagID" value="<?php echo $book[1] ?>" autocomplete="off">
                                </div>
                                <div class="col">
                                    <label for="seitenzahl" class="col-form-label">Seitenzahl:</label>
                                    <input type="text" class="form-control" name="seitenzahl" id="seitenzahl" placeholder="Seitenzahl" value="<?php echo $book[2] ?>" autocomplete="off">
                                </div>
                                <div class="col">
                                    <label for="typid" class="col-form-label">TypID:</label>
                                    <input type="text" class="form-control" name="typid" id="typid" placeholder="TypID" value="<?php echo $book[3] ?>" autocomplete="off">
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
                                    <label for="fachbereichid" class="col-form-label">FachbereichID:</label>
                                    <input type="text" class="form-control" name="fachbereichid" id="fachbereichid" placeholder="FachbereichID" value="<?php echo $book[6] ?>" autocomplete="off">
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

        <?php
                } else {
                    header("Location: user_book_search.php", true, 302);
                }
            } else {
                header("Location: user_book_search.php", true, 302);
            }
        } else {
            $book_userid = executeSQL("SELECT user_id FROM public.\"literatur\" WHERE literatur_id='$id'")->fetch()[0];
            if (isset($user_id)) {
                if ($user_id === $book_userid) {
                    executeSQL("UPDATE public.\"literatur\" SET title='" . $title . "',publisher_id='" . $verlagid . "',pages='" . $seitenzahl . "',type_id='" . $typid . "',author='" . $author . "',published_date='" . $veröffentlichungsdatum . "',fachbereich_id='" . $fachbereichid . "'  WHERE literatur_id=" . $id)->fetch();
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
                                echo "<td><a href='user_book_search.php?use=update&id=$b[0]' class='btn btn-primary'>Bearbeiten</a> <a href='user_book_search.php?use=delete&id=$b[0]' class='btn btn-danger'>Löschen</a></td>";
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
        <?php include "footer.php" ?>

</body>

</html>