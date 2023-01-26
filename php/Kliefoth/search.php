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
    include_once "../Dreessen/navbar.php";
    require_once "../Dreessen/Server_connect.php";
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location.href='../Cetin/page_login.php'</script>";
    }
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
    $books = executeSQL("SELECT title,publisher_id,pages,type_id,author,published_date,fachbereich_id,literatur_id FROM public.\"literatur\" WHERE title LIKE '$titel%' $sort")->fetchAll();
    if (isset($_GET['use'])) {
        $use = $_GET['use'];
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $user_id = $_SESSION['user_id'];
    if (isset($use)) {
        if ($use === "addbookmark") {
            executeSQL("INSERT INTO public. \"bookmark\" (literatur_id,user_id) VALUES ($id,$user_id)")->fetch();
            echo "<script>window.location.href='search.php'</script>";
        } else if ($use === "removebookmark") {
            executeSQL("DELETE FROM public. \"bookmark\" where literatur_id = $id and user_id=$user_id")->fetch();
            echo "<script>window.location.href='search.php'</script>";
        }
    }
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
                            <?php if ($user_id != null) { ?>
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
                            if ($user_id != null) {
                                $bookmark = executeSQL("SELECT literatur_id FROM public.\"bookmark\" WHERE literatur_id = $b[7] and user_id = $user_id")->fetch();
                                echo $bookmark;
                                if ($bookmark == null) {
                                    echo "<td><a class='btn border' href='search.php?use=addbookmark?id=$b[7]'>+</a></td>";
                                } else {
                                    echo "<td><a class='btn border' href='search.php?use=removebookmark?id=$b[7]'>-</a></td>";
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
</body>

</html>