<form method="post">
  <label for="sort">Sortieren nach:</label>
   <select id="sort" name="sort">
      <option value="type">Typ</option>
      <option value="type_id">ID</option>
   </select>
  <input type="submit" value="Sortieren">
</form>

<div class="table-responsive"><table class="table">
<thead>
<tr>
  <th>ID</th>
  <th>Typ</th>
  <th>Kommentar</th>
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
  echo "<td>".$row['type_id']."</td>";
  echo "<td>".$row['type']."</td>";
  echo "<td>".$row['comment']."</td>"; 
  echo '<td><form action="type-edit-form.php" method="GET">';
  echo '<input type="hidden" name="type_id" value="'.$row['type_id'].'">';
  echo '<input type="hidden" name="type" value="'.$row['type'].'">';
  echo '<input type="hidden" name="comment" value="'.$row['comment'].'">';
  echo '<input type="submit" name="edit" value="edit">';
  echo '</form></td>';
  echo '<td><form action="loeschenrow-type.php" method="post">';
  echo '<input type="hidden" name="type_id" value="'.$row['type_id'].'">';
  echo '<input type="submit" class="btn btn-danger" value="Löschen" onclick="return confirm(\'Sicher das Sie diesen Eintrag löschen möchten?\')">';
  echo '</form></td>';

  echo "</tr>";
}

?>
</script>
</tbody>
</table>
</div>