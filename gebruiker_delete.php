<?php
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
// hier komt straks een url om een nieuwe gebruiker aan te maken…

echo '</header>'; //afsluiten header
// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
// FORM EDIT gebruiker...
echo '<div id="frmDetail">';
if (isset($_GET["id"])) {
    $gebruikerId=$_GET["id"];
}
else {
    echo 'Klant niet gevonden...';
    header('refresh: 2; url=gebruikers.php');
}
$userObj = new User($dbconn_pdo);
$result = $userObj->getUser($gebruikerId);
$resultKlant = $result->fetch();

if($result->rowCount() !=1) {
    header('refresh: 2; url=gebruikers.php');
    exit();
}
?>

    <h4 style="color: #FF0000;">Weet u zeker dat u gebruiker '<?php echo $resultKlant['inlognaam'];?>' wilt verwijderen?</h4><br/>

    <form action ="dataverwerken.php" method="POST">
        <input type="hidden" name="action" value="DeleteUser">
        <input type="hidden" name="id" value="<?php echo $resultKlant['id'];?>">
        <input type="submit" name="verwijderen" value=" Ja! ">
        <input type="submit" name="terug" value=" Nee. ">
    </form>

<?php
echo '</main>';
?>