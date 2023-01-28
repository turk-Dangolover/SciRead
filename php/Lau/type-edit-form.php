
<?php
$id=$_GET['type_id'];
$type=$_GET['type'];
$comment=$_GET['comment'];
?>
<form action="update-type.php" method="post">
  <input type="hidden" name="type_id" value="<?php echo $id; ?>">
  <div class="form-element">
    <label for="type">Type:</label>
    <input type="text" name="newType" id="newType" value="<?php echo $type; ?>">
  </div>
  <div class="form-element">
    <label for="comment">Comment:</label>
    <input type="text" name="newComment" id="newComment" value="<?php echo $comment; ?>">
  </div>
  <input type="submit" value="Update" name="update"  class="btn btn-light" 
  onclick="alert('Type Updated!'); location.href = 'addType.php'; return true;" /><br><br>

</form>
