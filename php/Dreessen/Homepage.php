<?php
include_once 'navbar.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>SciRead|Homepage </title>
    </head>
    <body>
      <div class="container">    
        <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
          <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">Willkommen zu SciRead</h1>
          <p class="lead my-3">Die erste Datenbank, bei der man wissenschaftliche Literature suchen und speichern kann.</p>
          </div>
        </div> 
        <?php include_once '../Kliefoth/search.php'?>    
      </div>
      <?php include_once 'footer.php' ?>
    </body>
    <form>
    </form>
</html>