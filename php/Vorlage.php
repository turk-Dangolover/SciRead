Erstellt von Cem Cetin

/////////////////////////////////////

include navbar
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Überschrift der Website</h3> Ob Ihr H3 oder H2 benutzt soltle von der wichtigkeit der Seite abhängen. H3 ist Standard
        </div>
        <div class="card-body text-center container-fluid">
            Hier kommt der Haupt Inhalt der Seite rein
        </div>
    </div>
</div>
include footer

/////////////////////////////////////
Wie verwendet man Session_start()?

Wenn ihr die navbar integriert habt, müsst ihr kein session_start() befehl mehr ausführen.
Folgende Variabeln stehen zur Auswahl, diese werden gesetzt, wenn ein User sich einlogt.

$_SESSION['email'] = $email;
$_SESSION['passwort'] = $password;
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['roles_id'] = $row['roles_id'];
$_SESSION['login'] = TRUE;

Ihr könnt sie entweder direkt verwenden, oder besser, ihr speichert Sie in eine Variabel.
Wenn der User nicht eingelogt ist, könnt ihr das mit einem isset() Befehl überprüfen.
Andere möglichkeit gibt es auch, aber das ist die einfachste.

/////////////////////////////////////

Bitte schließt alle Sicherheitslücken mithilfe der Session_start() Funktion.
Kein User darf auf eine Seite zugreifen, auf die er keine Rechte hat.

Da die header Funktion nicht immer geht, empfehle ich euch, in eine if-Abfrage einfach include_once "../Cetin/401.php"; einzufügen.
Vergisst nicht die If-Abfrage mit einem return oder ähnlichen Befehlen zu schließen!!!!!

/////////////////////////////////////
