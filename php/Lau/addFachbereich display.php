<form method="post">
  <label for="sort">Sortieren nach:</label>
   <select id="sort" name="sort">
      <option value="fachbereich">Fachbereich</option>
      <option value="fachbereich_id">ID</option>
   </select>
  <input type="submit" value="Sortieren">
</form>

<div class="table-responsive"><table class="table">
<thead>
<tr>
  <th>ID</th>
  <th>Fachbereich</th>
  <th>Kommentar</th>
  <th></th>
</tr>
</thead>
<br>
<tbody>
<?php
require_once 'connect-server.php';
if(isset($_POST['sort'])){
  $varsort = $_POST['sort'];
  $sql= "SELECT * FROM fachbereich ORDER BY $varsort";
  $typen= executeSQL($sql)->fetchAll();
  }else{
  $sql = "SELECT * FROM fachbereich ORDER BY fachbereich_id";
  $typen= executeSQL($sql)->fetchAll();
  }
foreach ($typen as $row) {
  echo "<tr>";
  echo "<td>".$row['fachbereich_id']."</td>";
  echo "<td>".$row['fachbereich']."</td>";
  echo "<td>".$row['comment']."</td>";
  echo '<td><form action="fachbereich-edit-form.php" method="GET">';
  echo '<input type="hidden" name="fachbereich_id" value="'.$row['fachbereich_id'].'">';
  echo '<input type="hidden" name="fachbereich" value="'.$row['fachbereich'].'">';
  echo '<input type="hidden" name="comment" value="'.$row['comment'].'">';
  echo '<input type="submit" name="edit" value="edit">';
  echo '</form></td>';
  echo '<td><form action="loeschenrow-fachbereich.php" method="post">';
  echo '<input type="hidden" name="fachbereich_id" value="'.$row['fachbereich_id'].'">';
  echo '<input type="submit" class="btn btn-danger" value="Löschen" onclick="return confirm(\'Sicher das Sie diesen Eintrag löschen möchten?\')">';
  echo '</form></td>';
  echo "</tr>";
}

?>

</tbody>
</table>
</div>