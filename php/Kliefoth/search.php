<!DOCTYPE html>
<html lang="de">
<!--Autor: Jonas Kliefoth-->

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
        $sort = "ORDER BY Title ASC";
    }
    $books = executeSQL("SELECT title,pub.name,pages,ty.type,author,published_date,fb.fachbereich,lit.literatur_id FROM public.\"literatur\" lit LEFT JOIN fachbereich fb USING (fachbereich_id) LEFT JOIN publisher pub USING (publisher_id) LEFT JOIN type ty USING (type_id) WHERE title LIKE '$titel%' $sort")->fetchAll();
    if (isset($_GET['use'])) {
        $use = $_GET['use'];
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        if (isset($use)) {
            if ($use === "addbookmark") {
                $stmt = $dbConnection->prepare("INSERT INTO bookmark (literatur_id,user_id) VALUES (:lit_id,:user_id)");
                $stmt->bindValue(':lit_id', $id);
                $stmt->bindValue(':user_id', $user_id);
                $stmt->execute();
                echo "<script>window.location.href='search.php'</script>";
            } else if ($use === "removebookmark") {
                executeSQL("DELETE FROM public.\"bookmark\" where literatur_id = $id and user_id=$user_id")->execute();
                echo "<script>window.location.href='search.php'</script>";
            }
        }
    }
    ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Suche</h3>
            </div>
            <div class="card-body container-fluid">
                <form action="search.php" method="post" class="ms-5 me-5 border-top">
                    <div class="mb-3 mt-3 row align-items-end">
                        <div class="col-auto">
                            <div class="form-group">
                                <label for="titel" class="col-form-label">Suche:</label>
                                <input class="form-control" type="search" name="titel" id="titel" placeholder="Titel eingeben" value="<?php echo $titel ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-group">
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
                        </div>
                        <div class="col-auto">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Abschicken</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="ms-5 me-5">
                    <?php if (count($books) > 0) { ?>
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
                                    <?php if (isset($user_id)) { ?>
                                        <th></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($books as $b) {

                                    echo "<tr>";
                                    echo "<td>" . $b[0] . "</td>";
                                    echo "<td>" . $b[1] . "</td>";
                                    echo "<td>" . $b[2] . "</td>";
                                    echo "<td>" . $b[3] . "</td>";
                                    echo "<td>" . $b[4] . "</td>";
                                    echo "<td>" . $b[5] . "</td>";
                                    echo "<td>" . $b[6] . "</td>";
                                    if (isset($user_id)) {
                                        $bookmark = executeSQL("SELECT literatur_id FROM public.\"bookmark\" WHERE literatur_id = $b[7] and user_id = $user_id")->fetch();
                                        if ($bookmark == null) {
                                            echo "<td><a class='btn border' href='search.php?use=addbookmark&id=$b[7]'>+</a></td>";
                                        } else {
                                            echo "<td><a class='btn border' href='search.php?use=removebookmark&id=$b[7]'>-</a></td>";
                                        }
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
        </div>
    </div>
    <?php include "../Dreessen/footer.php" ?>
</body>

</html>