<!--
Erstellt von Cem Cetin
Datum: 13.01.2023
Beschreibung: Loggt den Benutzer aus
-->

<?php
session_start();
session_destroy();
header("Location: page_login.php");
?>
