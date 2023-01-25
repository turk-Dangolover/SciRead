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
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            <a class="text-muted" href="#"></a>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="Homepage copy.html">SciRead</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
            <a class="text-muted" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
            </a>
            <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
            <a class="btn btn-sm btn-outline-secondary" hred="#">Log In</a>
          </div>
        </div>
      </header>
                                      <!--Start der Nav bar-->
      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a class="p-2 text-muted" href="#">Übersicht</a>
          <a class="p-2 text-muted" href="Test.html">Hinzufügen</a>
          <a class="p-2 text-muted" href="#">User</a>
          
              <a class="p-2 text-muted" href="#">Adminbereich</a>
              

          
          <a class="p-2 text-muted" href="#"></a>
          <a class="p-2 text-muted" href="#"></a>
          <a class="p-2 text-muted" href="#"></a>
          <a class="p-2 text-muted" href="#"></a>
          <a class="p-2 text-muted" href="#"></a>
          <a class="p-2 text-muted" href="#"></a>
          <a class="p-2 text-muted" href="#"></a>
          <a class="p-2 text-muted" href="#"></a>
        </nav>
      </div>
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
    <label for="typ">Typ:</label>
    <input type="text" name="typ" id="typ">
  </div>
  <div class="form-element">
    <label for="kommentar">Anmerkungen:</label>
    <input type="text" name="kommentar" id="kommentar">
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