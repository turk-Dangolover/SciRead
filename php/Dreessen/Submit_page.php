<?php
include_once 'navbar.php';
include '../dreessen/Server_connect.php'

?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
                <div class="card-body container-fluid border">   
                    <form action="Submit_database.php" method="post">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="author">Autor:</label>
                                <input type="text" class="form-control" name="author" placeholder="Autor"  required>
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
                                    <option value="" disabled selected hidden>Wähle...</option>
                                    <?php
                                    $stmt = executeSQL("SELECT name FROM publisher ORDER BY name ASC");
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
                                <input type="number" min="0" class="form-control" name="seitenzahl" placeholder="1234" required>
                            </div>
                            <div class="invalid-feedback">
                                    Bitte gib die Seitenanzahl an.
                            </div>  
                            <div class="col-md-3 mb-3">
                            <label for fachbereich>Fachbereich</label>
                                <select class="custom-select mr-sm-2" name="fachbereich" required onchange="getFachbereichId(this.value)">
                                    <option value="" disabled selected hidden>Wähle...</option>
                                    <?php
                                    $stmt = executeSQL("SELECT fachbereich FROM fachbereich ORDER BY fachbereich ASC");
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
                                    <option value="" disabled selected hidden>Wähle...</option>
                                    <?php
                                    $stmt = executeSQL("SELECT type FROM type ORDER BY type ASC");
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
                        <button class="btn btn-primary" type="submit">Abschicken</button>
                            <!--bis hier--> 
                        <?php } ?>
                        <!--Not Loged In-->
                        <?php if($user_role != "1" && $user_role != "2" && $user_role != "3")
                            include_once '../Cetin/401.php'
                        ?>        
                    </form>
                </div>        
        </div>
        <?php include_once 'footer.php' ?>
    </body>
    <form >
    
    </form>
</html>
<script>
function getFachbereichId(fachbereich) {
  $.ajax({
    type: 'POST',
    url: 'Submit_database.php',
    data: {fachbereich: $varfachbereichid},
    success: function(response) {
      document.getElementById("fachbereich_id").value = response;
    }
  });
}
function getVerlagId(publisher) {
  $.ajax({
    type: 'POST',
    url: 'Submit_database.php',
    data: {publisher: $varverlagid},
    success: function(response) {
      document.getElementById("publisher_id").value = response;
    }
  });
}
function getTypId(type) {
  $.ajax({
    type: 'POST',
    url: 'Submit_database.php',
    data: {type: $vartypeid},
    success: function(response) {
      document.getElementById("type_id").value = response;
    }
  });
}
</script>
