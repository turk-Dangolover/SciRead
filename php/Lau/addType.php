<?php 
include_once "../Dreessen/navbar.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

      <div class=header>
          <h3 class="display-4 font-italic">Adminbereich Typ</h3>
</div> 
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="Administrationsbereich.php">Adminbereich</a></li>
    <li class="breadcrumb-item"><a href="addFachbereich.php">Fachbereich</a></li>
    <li class="breadcrumb-item active" aria-current="page">Typ</li>
    <li class="breadcrumb-item"><a href="addVerlag.php">Verlag</a></li>
  </ol>
</nav>
      <style>
  .form-element {
    float: left;
    padding: 15px;
  }
</style>

<form action="savetype.php" method="post">
  <div class="form-element">
    <label for="type">Typ:</label>
    <input type="text" name="type" id="type">
  </div>
  <div class="form-element">
    <label for="comment">Anmerkungen:</label>
    <input type="text" name="comment" id="comment">
  </div>
  <input type="submit" value="Upload" name="submit"  class="btn btn-light" 
  onclick="alert('New Type added!'); location.href = 'addType.php'; return true;" /><br><br>

</form>



<br><br>
<?php
include('addTyp display.php');
?>
</body>
</html>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"><\/script>')</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.8/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>