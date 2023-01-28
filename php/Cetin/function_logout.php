<!--
Erstellt von Cem Cetin
Beschreibung: Loggt den Benutzer aus
-->

<?php
session_start();
session_destroy();
header("Location: ../Dreessen/Homepage.php");
?>
