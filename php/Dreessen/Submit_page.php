<?php
include_once 'navbar.php';
include '../dreessen/Server_connect.php'

?>
<!DOCTYPE html>
<html>
    <head>
        <title>SciRead|Hinzufügen </title>
    </head>
    <body>
        <div class="container">    
            <!--lässt jemanden die Seite erst sehen wenn eingloggt -->
            <?php if ($login) { ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Hinzufügen<h3>
                    </div>
                </div>    
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
                        <label for publisher>Verlag:</label>
                            <select class="custom-select mr-sm-2" name="verlag" required onchange="getVerlagId(this.value)">
                                <option value="" disabled selected hidden>Choose...</option>
                                <?php
                                $stmt = executeSQL("SELECT name FROM publisher");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" id="publisher_id" name="publisher_id">
                            <div class="invalid-feedback">
                                Bitte gebe ein verlag an.
                            </div>
                        </div>      
                        <div class="col-md-3 mb-3">
                            <label for="Seitenzahl">Seitenanzahl:</label>
                            <input type="text" class="form-control" name="seitenzahl" placeholder="1234" required>
                        </div>
                        <div class="invalid-feedback">
                                Bitte gib die Seitenanzahl an.
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
                        <label for type>Typ:</label>
                            <select class="custom-select mr-sm-2" name="typ" required onchange="getTypId(this.value)">
                                <option value="" disabled selected hidden>Choose...</option>
                                <?php
                                $stmt = executeSQL("SELECT type FROM type");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" id="type_id" name="type_id">
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
                    <p>
                    <button class="btn btn-primary" type="submit">Submit form</button>
                        <!--bis hier--> 
                <?php } ?>
                <!--Not Loged In-->
                <?php if($user_role != "1" && $user_role != "2")
                    include_once '../Cetin/401.php'
                ?>        
            </form>
        </main>

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
function getVerlagId(publisher) {
  $.ajax({
    type: 'POST',
    url: 'Submit.php',
    data: {publisher: publisher},
    success: function(response) {
      document.getElementById("publisher_id").value = response;
    }
  });
}
function getTypId(type) {
  $.ajax({
    type: 'POST',
    url: 'Submit.php',
    data: {type: type},
    success: function(response) {
      document.getElementById("type_id").value = response;
    }
  });
}
</script>
