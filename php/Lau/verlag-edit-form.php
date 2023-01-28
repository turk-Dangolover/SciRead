<?php
$id=$_GET['publisher_id'];
$verlag=$_GET['name'];
$comment=$_GET['comment'];
?>
<form action="update-verlag.php" method="post">
  <input type="hidden" name="publisher_id" value="<?php echo $id; ?>">
  <div class="form-element">
    <label for="name">Verlag:</label>
    <input type="text" name="newName" id="newName" value="<?php echo $verlag; ?>">
  </div>
  <div class="form-element">
    <label for="comment">Anmerkungen:</label>
    <input type="text" name="newComment" id="newComment" value="<?php echo $comment; ?>">
  </div>
  <input type="submit" value="Update" name="update"  class="btn btn-light" 
  onclick="alert('Verlag wurde aktualisiert!'); location.href = 'addVerlag.php'; return true;" /><br><br>

</form>