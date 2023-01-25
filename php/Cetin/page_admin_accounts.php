<!--
Erstellt von Cem Cetin
Datum: 07.01.2023
Beschreibung: Website für die Verwaltung der Benutzer
-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link  rel="stylesheet" href="style.css">
    <title> SciReader | Admin AccountView</title>
</head>
<body>
<!-- Mein (Cem Cetin) Teil der Website -->
<?php
// Header wird eingebunden
include_once "navbar.php";
// Verbindung zur Datenbank
require 'connect.php';
// Holt die Rolle des Users aus der Session
$role = $_SESSION['roles_id'];
// Falls der User ein Admin ist, wird ihn der Inhalt der Seite angezeigt
if($role == '1'){
    // Holt alle Accounts aus der Datenbank
   $query = 'SELECT * FROM users';
   // Führt die Abfrage aus
   $res = $dbh->prepare($query);
   $res->execute();
   ?>
    <!-- Hier wird der Inhalt der Seite angezeigt -->
<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Admin Accounts</h3>
                    </div>
                    <div class="card-body text-center container-fluid">
                        <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Bearbeiten</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            //Hier wird die Tabelle mit den Accounts ausgegeben
                            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . $row['user_id'] . '</td>';
                                echo '<td>' . $row['email'] . '</td>';
                                //Da es nur zwei Rollen gibt, wurde hier eine if-else-Abfrage verwendet und keine foreach-Schleife
                                if ($row['roles_id'] == 1) {
                                    echo '<td>Admin</td>';
                                } else if ($row['roles_id'] == 2){
                                    echo '<td>User</td>';
                                } else {
                                    echo '<td>Kein Rolle vergeben</td>';
                                }
                                echo '<td><a class="btn btn-danger role="button" href="function_delete_account.php?id=' . $row['user_id'] . '">Löschen</a></td>';
                                echo '</tr>';                                                        
                            }
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php
   } else {
    // Falls der User kein Admin ist, wird Ihn eine Fehlermeldung angezeigt
    header('Location: 401.php');
   }
?>
</body>
</html>
    