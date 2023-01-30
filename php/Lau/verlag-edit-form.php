
<!Doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SciRead | Datenbankentitäten</title>
</head>

    <body>
    <?php include_once "../Dreessen/navbar.php"; 
     if (!isset($_SESSION['user_id'])) {
      include_once('../Cetin/401.php');
      return;
    }
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['roles_id'];
    if(!isset($role) ||$role==2) {
      include_once('../Cetin/401.php');
      return;
    } ?>
    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3>Verlag</h3>
                         </div>
                         <?php
$id=$_GET['publisher_id'];
$verlag=$_GET['name'];
$comment=$_GET['comment'];
?>
<form tyle="margin-left:20px" action="update-verlag.php" method="post">
<div class="col-md-12 mb-lg-4 ">
<label for="name">Verlag:</label>
<input type="hidden" name="publisher_id" value="<?php echo $id; ?>">
<input type="text" class="form-control" name="newName" id="newName" value="<?php echo $verlag; ?>">
  </div>
  <div class="col-md-12 mb-lg-4">
              <label for="comment">Anmerkungen</label>
    <input type="text" class="form-control" name="newComment" id="newComment" value="<?php echo $comment; ?>">
  </div>
  <div class="col-md-12 mb-lg-4 ">
  <input type="submit" value="Update" name="update"  class="btn btn-light" 
  onclick="alert('Verlag wurde aktualisiert!'); location.href = 'addVerlag.php'; return true;" /><br><br>
</div>
</form>
<br><br>
<?php include_once '../Dreessen/footer.php' ?>
</body>

</html>
