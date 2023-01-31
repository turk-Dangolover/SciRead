<form method="post">
  <div class="mb-3 mt-3 row align-items-end">
  <div class="col-auto">
  <div class="form-group">
    <label for="search-filter" class="col-form-label">Sortieren:</label>
    <select class="form-control" id="sort" name="sort">
      <option value="fachbereich_id">ID</option>
      <option value="fachbereich">Fachbereich</option>  
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

<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fachbereich</th>
        <th>Anmerkungen</th>
        <th></th>
      </tr>
    </thead>
    <br>
    <tbody>
      <?php
      require_once 'connect-server.php';
      if (isset($_POST['sort'])) {
        $varsort = $_POST['sort'];
        $sql = "SELECT * FROM fachbereich ORDER BY $varsort";
        $typen = executeSQL($sql)->fetchAll();
      } else {
        $sql = "SELECT * FROM fachbereich ORDER BY fachbereich_id";
        $typen = executeSQL($sql)->fetchAll();
      }
      foreach ($typen as $row) {
        echo "<tr>";
        echo "<td>" . $row['fachbereich_id'] . "</td>";
        echo "<td>" . $row['fachbereich'] . "</td>";
        echo "<td>" . $row['comment'] . "</td>";
        echo '<td><div class="row"><form action="fachbereich-edit-form.php" method="GET" class="px-2">';
        echo '<input type="hidden" name="fachbereich_id" value="' . $row['fachbereich_id'] . '">';
        echo '<input type="hidden" name="fachbereich" value="' . $row['fachbereich'] . '">';
        echo '<input type="hidden" name="comment" value="' . $row['comment'] . '">';
        echo '<input type="submit" class="btn btn-primary" name="edit" value="Bearbeiten">';
        echo '</form>';
        echo '<form action="loeschenrow-fachbereich.php" method="post">';
        echo '<input type="hidden" name="fachbereich_id" value="' . $row['fachbereich_id'] . '">';
        echo '<input type="submit" class="btn btn-danger" value="Löschen" onclick="return confirm(\'Sicher das Sie diesen Eintrag löschen möchten?\')">';
        echo '</form></div></td>';
        echo "</tr>";
      }

      ?>

    </tbody>
  </table>
</div>