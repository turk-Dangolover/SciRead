
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
        $vartyp= $_POST['type'];
        $varanmerkung= $_POST['comment'];

        require_once 'connect-server.php';
        $newID= (executeSQL("SELECT max(type_id) FROM type")->fetch())[0]+1;
        $insertLine = "INSERT INTO type(type_id, type, comment)
                VALUES ($newID, '$vartyp','$varanmerkung');";
        executeSQL($insertLine);
        header("Location: addType.php")
        ?>

        </body>
        </html>
      
      