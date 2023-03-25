<?php
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
echo '<p>Nieuwe gebruiker...</p>';
echo '</header>'; //afsluiten header

// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
// FORM EDIT gebruiker...
echo '<div id="frmDetail">';
// rol ophalen
$objRole = new Role($dbconn_pdo);
$rollen = $objRole->readRoleAll();
$rollen->setFetchMode(PDO::FETCH_ASSOC );
//Todo: verder met select...niet alle rollen worden getoond
?>
<div>
    <form action ="dataverwerken.php" method="POST" class="frmDetail">
        <input type="hidden" name="action" value="InsertUser">
        <label for="finlognaam">Inlognaam:</label>
        <input type="text" name="inlognaam" value="" id="finlognaam" placeholder="Inlognaam gebruiker...">
        <label for="fwachtwoord">Wachtwoord:</label>
        <input type="text" name="wachtwoord" value="" id="fwachtwoord" placeholder="Wachtwoord...">
        <label for="frol">Rol:</label>
        <select name="rol" id="rol">
            <?php
                foreach ($rollen as $rol) {
                    echo '<option value="'.$rol["id"].'">'.$rol['naam'].'</option><br>';
                }
            ?>
        </select>
        <div class="submitbtn">
            <input type="submit" name="submit" value="bewaren..." class="btnDetailSubmit">
        </div>
    </form>
</div>


<?php
echo '</div>';
echo '</main>';
include ("inc/footer.php");
?>
