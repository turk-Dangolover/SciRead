<?php
include_once 'navbar.php';
include 'Server_connect.php'

?>
<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <div class="container">    
            <!--lässt jemanden die Seite erst sehen wenn eingloggt -->
            <?php if ($login) { ?>
                <form action="Submit.php" method="post">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="author">Autor:</label>
                            <input type="text" class="form-control" name="author" placeholder="author"  required>
                            <div class="invalid-feedback">
                                Bitte gebe den Autor an.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="titel">Titel:</label>
                            <input type="text" class="form-control" name="titel" placeholder="Titel"  required>
                            <div class="invalid-feedback">
                                Bitte gib den Titel der literature an.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for verlag>Verlag:</label>
                            <select class="custom-select mr-sm-2" name="verlag" required onchange="getVerlagId(this.value)">
                                <option value="" disabled selected hidden>Choose...</option>
                                <?php
                                $stmt = executeSQL("SELECT name FROM verlag");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" id="verlag_id" name="verlag_id">
                            <div class="invalid-feedback">
                                Bitte gebe ein verlag an.
                            </div>
                        </div>      
                        <div class="col-md-3 mb-3">
                            <label for="Seitenzahl">Seitenanzahl:</label>
                            <input type="text" class="form-control" name="seitenzahl" placeholder="1234">
                        </div>  
                        <div class="col-md-3 mb-3">
                        <label for fachbereich>Fachbereich</label>
                            <select class="custom-select mr-sm-2" name="fachbereich" required onchange="getFachbereichId(this.value)">
                                <option value="" disabled selected hidden>Choose...</option>
                                <?php
                                $stmt = executeSQL("SELECT fachbereich FROM fachbereich");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['fachbereich'] . '">' . $row['fachbereich'] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" id="fachbereich_id" name="fachbereich_id">
                            <div class="invalid-feedback">
                                Bitte gebe ein Fachbereich an.
                            </div>
                        </div>               
                        <div class="col-md-3 mb-3">
                        <label for typ>Typ:</label>
                            <select class="custom-select mr-sm-2" name="typ" required onchange="getTypId(this.value)">
                                <option value="" disabled selected hidden>Choose...</option>
                                <?php
                                $stmt = executeSQL("SELECT typ FROM typ");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['typ'] . '">' . $row['typ'] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" id="typ_id" name="typ_id">
                            <div class="invalid-feedback">
                                Bitte gebe ein Fachbereich an.
                            </div>
                        </div>       
                        <div class="col-md-3 mb-3">
                            <label for="veroeffentlichungdatum">Veröffentlichungsdatum:</label>
                            <input type="date" class="form-control" name="veroeffentlichungdatum" placeholder="DD.MM.YYYY" required>
                            <div class="invalid-feedback">
                                Bitte gebe das Veröffentlichungsdatum an.
                            </div>
                        </div>  
                        <div class="col-md-12 mb-lg-4 ">
                            <label for="Kommentar">Kommentar</label>
                            <input type="text" class="form-control" name="Kommentar" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" >
                    </div>
                    <p>
                    <button class="btn btn-primary" type="submit">Submit form</button>
                        <!--bis hier--> 
                <?php } ?>
                <!--Not Loged In-->
                <?php if($user_role != "1" && $user_role != "2")
                    echo '<h1>Error 401</h1><p> <h1> Nicht autorisierter Zugriff </h1>'
                ?>        
            </form>
        </main>
      <footer class="blog-footer">
        <p>Blog template built from <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>. and edited by <a href="#">Kevin</a></p> 
        <p>
        <a href="#">Back to top</a>
        </p>
    </footer>
    </body>
    <form >
    </form>
</html>
<script>
function getFachbereichId(fachbereich) {
  $.ajax({
    type: 'POST',
    url: 'Submit.php',
    data: {fachbereich: fachbereich},
    success: function(response) {
      document.getElementById("fachbereich_id").value = response;
    }
  });
}
function getVerlagId(fachbereich) {
  $.ajax({
    type: 'POST',
    url: 'Submit.php',
    data: {verlag: verlag},
    success: function(response) {
      document.getElementById("verlag_id").value = response;
    }
  });
}
function getTypId(fachbereich) {
  $.ajax({
    type: 'POST',
    url: 'Submit.php',
    data: {typ: typ},
    success: function(response) {
      document.getElementById("typ_id").value = response;
    }
  });
}
</script>
