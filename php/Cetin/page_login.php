<!--
Erstellt von Cem Cetin
Beschreibung: Login Seite
-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="../../css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>SciRead | Login</title>

</head>
<body>
<!-- Navbar einbinden -->
<?php
	include_once "../Dreessen/navbar.php";
?>
<div class="container py-5">
  <div class="d-flex justify-content-center">
        <!-- col-xl-10 beschränkt die Größe bei großen Bildschirmen -->
    <div class="col col-xl-10">
      <div class="card" style="border-radius: 1rem;">
        <div class="row">
          <!-- Bei kleinen Bildschirmen wird das Bild ausgeblendet -->
          <div class=" col-lg-5 d-none d-lg-block">
            <img src="https://images.pexels.com/photos/1907784/pexels-photo-1907784.jpeg?auto=compress&cs=tinysrgb&w=1600"
            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
          </div>
          <div class="col-md-6 col-lg-7 d-flex align-items-center">
            <div class="card-body p-lg-7 text-black">
              <div class="d-flex align-items-center mb-3 pb-1">
                <div class="d-flex align-items-center" >
                  <img src="../../pic/Icon.webp" alt="login Icon" class="img-circle img-fluid" /> 
                  <span class="h1 fw-bold mb-0">Login</span>
                </div>
              </div>
              <h5 class="mb-3 pb-3" style="letter-spacing: 1px;">Melde dich mit in dein Account ein </h5>
              <form method="post" action="function_login.php">
                <div class="mb-4">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" />
                  <label class="form-label" for="email">Email Adresse</label>
                </div>
                <div class="mb-4">
                  <input type="password" id="kennwort" name="kennwort" class="form-control form-control-lg" />
                  <label class="form-label" for="kennwort">Kennwort</label>
                </div>
                <div class="pt-1 mb-4">
                  <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                </div>
              </form> 
              <p class="mb-5 pb-lg-2" style="color: #393f81;">Neu bei SciRead? <a href="page_register.php" >Registrieren</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Footer einbinden -->
<?php
include_once "../Dreessen/footer.php";
?>
</body>
</html>