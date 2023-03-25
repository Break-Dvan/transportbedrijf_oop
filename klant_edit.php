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
$qryKlant = "SELECT id, naam, cp,  straat, huisnummer, postcode, plaats, telefoon, notitie
        FROM Klant
        WHERE id=:klantid";
//result...
//$resultKlant = mysqli_query($dbconn, $qryKlant);
$stmt = $dbconn_pdo->prepare($qryKlant);
$stmt->bindParam(":klantid", $klantId);
$stmt->execute();

$row_count=$stmt->rowCount();
//if(!mysqli_num_rows($resultKlant)==1) {
if(!$row_count==1) {
    echo 'Er zijn meerdere klanten geselecteerd. Dit gaat niet goed!';
    header('refresh: 2; url=klantgegevens.php');
}
//1 record...
//$klant=mysqli_fetch_assoc($resultKlant);
$klant=$stmt->fetch(PDO::FETCH_ASSOC); //let op: gebruik fetch en niet fetchAll...

?>
<div>
    <form action ="dataverwerken.php" method="POST" class="frmDetail">
        <input type="hidden" name="action" value="UpdateKlant">
        <label for="fklantnr">Klantnr.:</label>
        <input type="text" name="klantnr" value="<?php echo $klantId;?>" id="fklantnr">
        <label for="fklantnaam">Naam klant:</label>
        <input type="text" name="klantnaam" value="<?php echo $klant["naam"];?>" id="fklantnaam">
        <label for="fcontactpersoon">Contactpersoon.:</label>
        <input type="text" name="contactpersoon" value="<?php echo $klant["cp"];?>" id="fcontactpersoon">
        <label for="fstraat">Straat:</label>
        <input type="text" name="straat" value="<?php echo $klant["straat"];?>" id="fstraat">
        <label for="fhuisnummer">Huisnummer:</label>
        <input type="text" name="huisnummer" value="<?php echo $klant["huisnummer"];?>" id="fhuisnummer">
        <label for="fpostcode">Postcode:</label>
        <input type="text" name="postcode" value="<?php echo $klant["postcode"];?>" id="fpostcode">
        <label for="fplaats">Plaats:</label>
        <input type="text" name="plaats" value="<?php echo $klant["plaats"];?>" id="fplaats">
        <label for="ftelefoon">Telefoon:</label>
        <input type="text" name="telefoon" value="<?php echo $klant["telefoon"];?>" id="ftelefoon">
        <label for="fnotitie">Notitie:</label>
        <input type="text" name="notitie" value="<?php echo $klant["notitie"];?>" id="fnotitie">
        <div class="submitbtn">
            <input type="submit" name="submit" value="bewaren..." class="btnDetailSubmit">
        </div>
    </form>
</div>
<?php
echo '</div>'; //frmDetail
echo '</main>'; //main-content
include ("inc/footer.php");
?>
