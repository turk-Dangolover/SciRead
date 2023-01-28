<!--
Erstellt von Cem Cetin
Beschreibung: Website für die Verwaltung der Benutzer
-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title> SciRead | Admin AccountView</title>
</head>
<body>
<!-- Mein (Cem Cetin) Teil der Website -->
<?php
// Header wird eingebunden
include_once "../Dreessen/navbar.php";
// Verbindung zur Datenbank
require 'connect.php';
// Prüft ob der User eingelogt ist
if(!(isset($_SESSION['roles_id']))){
    include_once "401.php";
    return;
}
// Holt die Rolle des Users aus der Session
$role = $_SESSION['roles_id'];
// Falls der User ein Admin ist, wird ihn der Inhalt der Seite angezeigt
if(($role == '1' || $role == '3')){
    // Holt alle Accounts aus der Datenbank
   $query = 'SELECT * FROM users';
   // Führt die Abfrage aus
   $stmt = $dbh->prepare($query);
   $stmt->execute();
   ?>
    <!-- Hier wird der Inhalt der Seite angezeigt -->
<div class="container">
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
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $row['user_id'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        //Da es nur zwei Rollen gibt, wurde hier eine if-else-Abfrage verwendet und keine foreach-Schleife
                        if ($row['roles_id'] == 1) {
                        echo '<td>Admin</td>';
                        } else if ($row['roles_id'] == 2){
                        echo '<td>User</td>';
                        } else {
                        echo '<td>Owner</td>';
                        }
                        if($role == 3){
                        echo '<td><button class="btn btn-warning" onclick="switchRole(' . $row['user_id'] . ')">Rolle ändern</button>';
                        echo '<button class="btn btn-danger" onclick="deleteAccount(' . $row['user_id'] . ')">Löschen</button></td>';
                        echo '</tr>';
                        }      
                        if($role == 1){
                            echo '<td><button class="btn btn-danger" onclick="deleteAccount(' . $row['user_id'] . ')">Löschen</button></td>';
                            echo '</tr>';
                            }                                 
                        }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Footer wird eingebunden -->
<?php
include_once "../Dreessen/footer.php";
?>
<?php
   } else {
    // Falls der User kein Admin ist, wird Ihn eine Fehlermeldung angezeigt
    include_once "401.php";
   }
?>
</body>
<!--Pop Up der zum Löschskript weiterleitet -->
<script type="text/javascript">
function deleteAccount(id) {
    var id = id;
    var confirm = window.confirm('Möchten Sie diesen Account wirklich löschen?');
    if (confirm)
    {
        window.location.href = "function_delete_account.php?id=" + id;
    } else {
        window.location.href = "page_admin_accounts.php";
    }
}

function switchRole(id) {
    var id = id;
    var confirm = window.confirm('Möchten Sie die Rolle dieses Account wirklich ändern?');
    if (confirm)
    {
        window.location.href = "function_switch_role.php?id=" + id;
    } else {
        window.location.href = "page_admin_accounts.php";
    }
}
</script>  
</html>