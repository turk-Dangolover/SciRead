<?php
$id=$_GET['fachbereich_id'];
$fachberech=$_GET['fachbereich'];
$comment=$_GET['comment'];
?>
<form action="update-fachbereich.php" method="post">
  <input type="hidden" name="fachbereich_id" value="<?php echo $id; ?>">
  <div class="form-element">
    <label for="facgbereich">Fachbereich:</label>
    <input type="text" name="newFachbereich" id="newFachbereich" value="<?php echo $fachberech; ?>">
  </div>
  <div class="form-element">
    <label for="comment">Anmerkungen:</label>
    <input type="text" name="newComment" id="newComment" value="<?php echo $comment; ?>">
  </div>
  <input type="submit" value="Update" name="update"  class="btn btn-light" 
  onclick="alert('Fachbereich wurde aktualisiert!'); location.href = 'addFachbereich.php'; return true;" /><br><br>

</form>