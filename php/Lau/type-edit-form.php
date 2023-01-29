<!Doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SciRead | Datenbankentitäten</title>
</head>

    <body>
    <?php include_once "../Dreessen/navbar.php"; ?>
    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3>Fachbereich</h3>
                         </div>

<?php
$id=$_GET['type_id'];
$type=$_GET['type'];
$comment=$_GET['comment'];
?>
<br><br>
<form tyle="margin-left:20px" action="update-type.php" method="post">
<div class="col-md-12 mb-lg-4 ">   
<label for="type">Typ:</label>
  <input type="hidden" name="type_id" value="<?php echo $id; ?>">
    <input type="text" class="form-control" name="newType" id="newType" value="<?php echo $type; ?>" required>
  </div>
  <div class="col-md-12 mb-lg-4">
              <label for="comment">Anmerkungen:</label>
    <input type="text" class="form-control" name="newComment" id="newComment" value="<?php echo $comment; ?>">
  </div>
  <div class="col-md-12 mb-lg-4 ">
  <input type="submit" value="Update" name="update"  class="btn btn-light" 
  onclick="alert('Fachbereich wurde aktualisiert!'); location.href = 'addType.php'; return true;" /><br><br>
</div>
</form>
<br><br>
<?php include_once '../Dreessen/footer.php' ?>
</body>

</html>
