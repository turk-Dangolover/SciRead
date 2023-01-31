
<?php
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
  <form method="post">
<div class="mb-3 mt-3 row align-items-end">
  <div class="col-auto">
  <div class="form-group">
  <label for="sort">Sortieren nach:</label>
  <select class="form-control" id="sort" name="sort">
      <option value="type">Typ</option>
      <option value="type_id">ID</option>
   </select>
   </div>
</div>
 
    <div class="col-auto">
      <div class="form-group">
        <button type="submit" class="btn btn-light">Abschicken</button>
      </div>
    </div>
</div>
</form>

<div class="table-responsive"><table class="table">
<thead>
<tr>
  <th>ID</th>
  <th>Typ</th>
  <th>Anmerkungen</th>
  <th></th>
  <th></th>
</tr>
</thead>
<br>
<tbody>
<?php
require_once 'connect-server.php';
if(isset($_POST['sort'])){
  $varsort = $_POST['sort'];
  $sql= "SELECT * FROM type ORDER BY $varsort";
  $typen= executeSQL($sql)->fetchAll();
  }else{
  $sql = "SELECT * FROM type ORDER BY type_id";
  $typen= executeSQL($sql)->fetchAll();
  }
foreach ($typen as $row) {
        echo "<tr>";
        echo "<td>" . $row['type_id'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['comment'] . "</td>"; 
        echo '<td><div class="row"><form action="type-edit-form.php" method="GET" class="px-2">';
        echo '<input type="hidden" name="type_id" value="' . $row['type_id'] . '">';
        echo '<input type="hidden" name="type" value="' . $row['type'] . '">';
        echo '<input type="hidden" name="comment" value="' . $row['comment'] . '">';
        echo '<input type="submit" class="btn btn-primary" name="edit" value="Bearbeiten">';
        echo '</form>';
        echo '<form action="loeschenrow-type.php" method="post">';
        echo '<input type="hidden" name="type_id" value="' . $row['type_id'] . '">';
        echo '<input type="submit" class="btn btn-danger" value="Löschen" onclick="return confirm(\'Sicher das Sie diesen Eintrag löschen möchten?\')">';
        echo '</form></div></td>';
        echo "</tr>";
}

?>
</script>
</tbody>
</table>
</div>