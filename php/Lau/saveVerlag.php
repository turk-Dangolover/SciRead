<html>

<body>
  <?php
  include_once('../Dreessen/Navbar.php');
  if (!isset($_SESSION['user_id'])) {
    include_once('../Cetin/401.php');
    return;
  }
  $user_id = $_SESSION['user_id'];
  $role = $_SESSION['roles_id'];
  if (!isset($role) || $role == 2) {
    include_once('../Cetin/401.php');
    return;
  }
  $varverlag = $_POST['name'];
  $varanmerkung = $_POST['comment'];

  require_once 'connect-server.php';
  $newID = (executeSQL("SELECT max(publisher_id) FROM publisher")->fetch())[0] + 1;
  $insertLine = "INSERT INTO publisher(publisher_id, name, comment)
                VALUES ($newID, '$varverlag','$varanmerkung');";
  executeSQL($insertLine);
  header("Location: addVerlag.php")
  ?>

</body>

</html>