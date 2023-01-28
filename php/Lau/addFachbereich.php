<?php 
    include_once "../Dreessen/navbar.php";
?>
<!Doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>SciRead | Adminbereich</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="blog.css" rel="stylesheet">
  </head>

    <body>
        <div class=header>
          <h3 class="display-4 font-italic">Adminbereich Fachbereich</h3>
</div> 
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="Administrationsbereich.php">Adminbereich</a></li>  
   <li class="breadcrumb-item active" aria-current="page">Fachbereich</li>
    <li class="breadcrumb-item"><a href="addType.php">Typ</a></li>
    <li class="breadcrumb-item"><a href="addVerlag.php">Verlag</a></li>
  </ol>
</nav>
      <style>
  .form-element {
    float: left;
    padding: 15px;
  }
</style>

<form action="savefachbereich.php" method="post">
  <div class="form-element">
    <label for="fachbereich">Fachbereich:</label>
    <input type="text" name="fachbereich" id="fachbereich">
  </div>
  <div class="form-element">
    <label for="comment">Anmerkungen:</label>
    <input type="text" name="comment" id="comment">
  </div>
  <input type="submit" value="Upload" name="submit"  class="btn btn-light" 
  onclick="alert('New Type added!'); location.href = 'addFachbereich.php'; return true;" /><br><br>

</form>



<br><br>
<?php
include('addFachbereich display.php');
?>
        <?php include "../Dreessen/footer.php" ?>
</body>
</html>