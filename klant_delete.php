<?php
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
// hier komt straks een url om een nieuwe klant aan te maken…

echo '</header>'; //afsluiten header
// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
// FORM EDIT klant...
echo '<div id="frmDetail">';
if (isset($_GET["id"])) {
    $klantId=$_GET["id"];
}
else {
    echo 'Klant niet gevonden...';
    header('refresh: 2; url=klantgegevens.php');
}