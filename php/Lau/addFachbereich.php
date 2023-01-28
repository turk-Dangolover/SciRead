<!Doctype html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php include_once "../Dreessen/navbar.php"; ?>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3>Fachbereiche</h3>
      </div>

      <div class="card-body">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="Administrationsbereich.php">Adminbereich</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fachbereiche</li>
            <li class="breadcrumb-item"><a href="addType.php">Typen</a></li>
            <li class="breadcrumb-item"><a href="addVerlag.php">Verläge</a></li>
          </ol>
        </nav>
        <form tyle="margin-left:20px" action="savefachbereich.php" method="post">
          <div class="row align-items-end">
            <div class="col-md-4 mb-3">
              <label for="fachbereich">Fachbereich:</label>
              <input type="text" class="form-control" name="fachbereich" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="comment">Anmerkungen</label>
              <input type="text" class="form-control" name="comment" id="comment">
</div>

            <div class="col-auto">
              <button type="submit" name="submit" class="btn btn-light" onclick="alert('Neuer Fachbereich hinzugefügt!'); location.href = 'addFachbereich.php'; return true;">Upload</button><br><br>
</div>
</div>
        </form>
        <?php
        include('addFachbereich display.php');
        ?>
      </div>
    </div>
  </div>


<?php include_once '../Dreessen/footer.php' ?>
</body>
</html>