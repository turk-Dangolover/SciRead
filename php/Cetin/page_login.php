<!--
Erstellt von Cem Cetin
Datum: 01.01.2023
Beschreibung: Login Seite
-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link  rel="stylesheet" href="../../css/style.css">
    <title>Login</title>

</head>
<body>
<?php
	include_once "../Dreessen/navbar.php";
?>
<div class="container py-5">
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col col-xl-10">
      <div class="card" style="border-radius: 1rem;">
        <div class="row g-0">
          <div class=" col-lg-5 d-none d-md-block">
            <img src="https://images.pexels.com/photos/1907784/pexels-photo-1907784.jpeg?auto=compress&cs=tinysrgb&w=1600"
            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
          </div>
          <div class="col-md-6 col-lg-7 d-flex align-items-center">
            <div class="card-body p-lg-7 text-black">
              <div class="d-flex align-items-center mb-3 pb-1">
                <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                <div class="d-flex align-items-center" >
                  <img src="../../pic/Icon.webp" alt="login Icon" class="img-circle img-fluid" /> 
                  <span class="h1 fw-bold mb-0">Login</span>
                </div>
              </div>
              <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Melde dich mit in dein Account ein </h5>
              <form method="post" action="function_login.php">
                <div class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" />
                  <label class="form-label" for="email">Email Adresse</label>
                </div>
                <div class="form-outline mb-4">
                  <input type="password" id="kennwort" name="kennwort" class="form-control form-control-lg" />
                  <label class="form-label" for="kennwort">Kennwort</label>
                </div>
                <div class="pt-1 mb-4">
                  <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                </div>
              </form> 
              <p class="mb-5 pb-lg-2" style="color: #393f81;">Neu bei SciRead? <a href="page_register.php" style="color: #393f81;">Registrieren</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once "../Dreessen/footer.php";
?>
</body>
</html>