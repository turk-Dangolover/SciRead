<form method="post">
  <label for="sort">Sortieren nach:</label>
   <select id="sort" name="sort">
      <option value="typ">Typ</option>
      <option value="id">ID</option>
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
</tr>
</thead>
<br>
<tbody>
<?php
require_once 'connect-server.php';
if(isset($_POST['sort'])){
  $varsort = $_POST['sort'];
  $sql= "SELECT * FROM typ ORDER BY $varsort";
  $typen= executeSQL($sql)->fetchAll();
  }else{
  $sql = "SELECT * FROM typ ORDER BY id";
  $typen= executeSQL($sql)->fetchAll();
  }
foreach ($typen as $row) {
  echo "<tr>";
  echo "<td>".$row['id']."</td>";
  echo "<td>".$row['typ']."</td>";
  echo "<td>".$row['kommentar']."</td>";
  echo '<td><form action="loeschenrow-type.php" method="post">';
  echo '<input type="hidden" name="id" value="'.$row['id'].'">';
  echo '<input type="submit" class="btn btn-danger" value="Löschen" onclick="return confirm(\'Sicher das Sie diesen Eintrag löschen möchten?\')">';
  echo '</form></td>';
  echo "</tr>";
}

?>

</tbody>
</table>
</div>