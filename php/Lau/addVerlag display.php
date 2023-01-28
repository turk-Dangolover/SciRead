<form method="post">
  <label for="sort">Sortieren nach:</label>
   <select id="sort" name="sort">
      <option value="name">Verlag</option>
      <option value="publisher_id">ID</option>
   </select>
  <input type="submit" value="Sortieren">
</form>

<div class="table-responsive"><table class="table">
<thead>
<tr>
  <th>ID</th>
  <th>Verlag</th>
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
  $sql= "SELECT * FROM publisher ORDER BY $varsort";
  $verlage= executeSQL($sql)->fetchAll();
  }else{
  $sql = "SELECT * FROM publisher ORDER BY publisher_id";
  $verlage= executeSQL($sql)->fetchAll();
  }
foreach ($verlage as $row) {
  echo "<tr>";
  echo "<td>".$row['publisher_id']."</td>";
  echo "<td>".$row['name']."</td>";
  echo "<td>".$row['comment']."</td>";
  echo '<td><form action="verlag-edit-form.php" method="GET">';
  echo '<input type="hidden" name="publisher_id" value="'.$row['publisher_id'].'">';
  echo '<input type="hidden" name="name" value="'.$row['name'].'">';
  echo '<input type="hidden" name="comment" value="'.$row['comment'].'">';
  echo '<input type="submit" name="edit" value="edit">';
  echo '</form></td>';
  echo '<td><form action="loeschenrow-verlag.php" method="post">';
  echo '<input type="hidden" name="publisher_id" value="'.$row['publisher_id'].'">';
  echo '<input type="submit" class="btn btn-danger" value="Löschen" onclick="return confirm(\'Sicher das Sie diesen Eintrag löschen möchten?\')">';
  echo '</form></td>';
  echo "</tr>";
}

?>

</tbody>
</table>
</div>