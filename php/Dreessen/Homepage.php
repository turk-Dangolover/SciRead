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
          <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Weiterlesen...</a></p>
          </div>
        </div>
        <div class="card-columns">
            <div class="card">
              <img class="card-img-top" src="../../pic/uebersicht.PNG" alt="100%x260" style="height: 260px; width: 100%; display: block;">
              <div class="card-body">
                <h5 class="card-title">Übersicht</h5>
                <p class="card-text">Unter Übersicht kann jeder alle eingetragenen wissenschatlichen Literaturen einsehen.</p>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="../../pic/Hinzufuegen.PNG" alt="100%x260" style="height: 260px; width: 100%; display: block;">
              <div class="card-body">
                <?php if($login){
                  echo
                  '<h5 class="card-title">
                  <a class="text-dark" href="#">Hinzufügen</a>
                  </h5>';
                  echo '<p class="card-text">Hier kannst du deine eigene oder jemandes wissenschaftliche Literature hinzufügen.</p>'; }
                  else{
                  echo
                  '<h5 class="card-title">
                  <a class="text-dark" href=""../Cetin/page_login.php"">Hinzufügen</a>
                  </h5>';
                  echo '<p class="card-text">Dieses Feature der Website ist nur einsehbar wenn du angemeldet bist.</p>';
                  }
                ?>
              </div>
            </div>
          <div class="card">
            <img class="card-img-top" src="../../pic/User.PNG" alt="100%x260" style="height: 260px; width: 100%; display: block;">
            <div class="card-body">
              <?php if($login){
                echo
                '<h5 class="card-title">
                <a class="text-dark" href="#">User</a>
                </h3>';
                echo '<p class="card-text">Bei diesem feature kannst du alles User basiertes einsehen</p><p></p>'; }
                else{
                echo
               '<h3 class="mb-0">
                <a class="text-dark" href=""../Cetin/page_login.php"">User</a>
                </h3>';
                echo '<p class="card-text">Dieses Feature der Website ist nur einsehbar wenn du angemeldet bist.</p><p></p>';
                }
              ?>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="../../pic/Adminbereich.PNG" alt="100%x260" style="height: 260px; width: 100%; display: block;">
            <div class="card-body">
              <?php if($user_role == "2" || $user_role == '0'){
                echo
                '<h5 class="card-title">
                <a class="text-dark" href="#">Adminbereich</a>
                </h3>';
                echo '<p class="card-text">Beim Adminbereich verwaltet man die User und Literature </p>'; }
                else{
                echo
               '<h3 class="mb-0">
                <a class="text-dark" href=""../Cetin/page_login.php"">Adminbereich</a>
                </h3>';
                echo '<p class="card-text">Dieses Feature der Website ist nur einsehbar wenn du angemeldet bist.</p>';
                }
              ?>
            </div>
          </div>
        </div>      
      </div>
      
      <?php include_once 'footer.php' ?>
    </body>
    <form>
    </form>
</html>