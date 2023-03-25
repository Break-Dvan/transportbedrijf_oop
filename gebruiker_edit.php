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
    echo 'gebruiker niet gevonden...';
    header('refresh: 2; url=gebruikergegevens.php');
}
$qryGebruiker = "SELECT id, inlognaam, wachtwoord, rol_id FROM Gebruiker
        WHERE id=:gebruikerid";
//result...
//$resultgebruiker = mysqli_query($dbconn, $qryGebruiker);
$stmt = $dbconn_pdo->prepare($qryGebruiker);
$stmt->bindParam(":gebruikerid", $gebruikerId);
$stmt->execute();

$row_count=$stmt->rowCount();
//if(!mysqli_num_rows($resultGebruiker)==1) {
if(!$row_count==1) {
    echo 'Er zijn meerdere gebruikers geselecteerd. Dit gaat niet goed!';
    header('refresh: 2; url=gebruikergegevens.php');
}
//1 record...
//$gebruiker=mysqli_fetch_assoc($resultgebruiker);
$gebruiker=$stmt->fetch(PDO::FETCH_ASSOC); //let op: gebruik fetch en niet fetchAll...
//id, inlognaam, wachtwoord, rol_idvalue="<?php echo $klantId;
// rol ophalen
$objRole = new Role($dbconn_pdo);
$rollen = $objRole->readRoleAll();
$rollen->setFetchMode(PDO::FETCH_ASSOC );
?>
<div>
    <form action ="dataverwerken.php" method="POST" class="frmDetail">
        <input type="hidden" name="action" value="UpdateUser">
        <label for="fid">Inlognaam:</label>
        <input type="text" name="id" value="<?php echo $gebruiker['id'];?>" id="fid">
        <label for="finlognaam">Inlognaam:</label>
        <input type="text" name="inlognaam" value="<?php echo $gebruiker['inlognaam'];?>" id="finlognaam" placeholder="Inlognaam gebruiker...">
        <label for="fwachtwoord">Wachtwoord:</label>
        <input type="text" name="wachtwoord" value="<?php echo $gebruiker['wachtwoord'];?>" id="fwachtwoord" placeholder="Wachtwoord...">
        <label for="frol">Rol:</label>
        <select name="rol" id="rol">
            <?php
                foreach ($rollen as $rol) {
                    if ($rol['id']==$gebruiker["rol_id"])
                        echo '<option value="'.$rol["id"].'"selected>'.$rol['naam'].'</option><br>';
                    else {
                        echo '<option value="'.$rol["id"].'">'.$rol['naam'].'</option><br>';
                    }
                }
            ?>
        </select>
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
