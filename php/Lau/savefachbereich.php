<html>
<body>
  <?php
   if (!isset($_SESSION['user_id'])) {
        include_once('../Cetin/401.php');
        return;
      }
      $user_id = $_SESSION['user_id'];
      $role = $_SESSION['roles_id'];
      if(!isset($role) ||$role==2){
        include_once ('../Cetin/401.php');
        return;
        }
        $varfachbereich= $_POST['fachbereich'];
        $varanmerkung= $_POST['comment'];

        require_once 'connect-server.php';
        $newID= (executeSQL("SELECT max(fachbereich_id) FROM fachbereich")->fetch())[0]+1;
        $insertLine = "INSERT INTO fachbereich(fachbereich_id, fachbereich, comment)
                VALUES ($newID, '$varfachbereich','$varanmerkung');";
        executeSQL($insertLine);
        header("Location: addFachbereich.php")
        ?>

        </body>
        </html>