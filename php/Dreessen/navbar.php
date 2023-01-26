<?php
session_start();
if(isset($_SESSION['roles_id'])){
    $user_role = $_SESSION['roles_id'];
    $login = $_SESSION['login'];
    } else {
    $user_role = 0;
    $login = FALSE;
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></scipt>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link  rel="stylesheet" href="../css/style.css">

    <!-- Styles von Kevin -->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.0/examples/blog/blog.css" rel="stylesheet">
    <link rel="icon" href="../pic/Icon.webp">
</head>
<body>
     <!-- Header von Kevin -->
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="#"></a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="../Dreessen/Homepage.php">SciRead</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="text-muted" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                </a>
                
                <?php if($login){
                  echo '<a class="btn btn-sm btn-outline-secondary" href="../Cetin/function_logout.php">Sign Out</a>';
                }
                else{
                  echo '<a class="btn btn-sm btn-outline-secondary" href="../Cetin/page_login.php">Log In</a>';
                  echo '<a class="btn btn-sm btn-outline-secondary" href="../Cetin/page_register.php">Sign Up</a>';
                }
                ?>
            </div>
        </div>
    </header>
        <!--Start der Nav bar-->
      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a class="p-2 text-muted" href="../Kliefoth/search.php">Übersicht</a>
          <?php if ($login){
            echo '<a class="p-2 text-muted" href="../Dreessen/Submit.php">Hinzufügen</a>';
            echo '<a class="p-2 text-muted" href="../Cetin/page_profile.php">User</a>';
          }
          else{
            echo '<a class="p-2 text-muted" href="../Cetin/page_login.php">Hinzufügen</a>';
            echo '<a class="p-2 text-muted" href="../Cetin/page_login.php">User</a>';
          }
          ?>
          <?php if($user_role != "1"){
          echo '<a class="p-2 text-muted" href="#" style="display:none;">Adminbereich</a>';
          }
          else{
           echo '<a class="p-2 text-muted" href="../Cetin/page_admin.php">Adminbereich</a>';
          }?>

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
</div>
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