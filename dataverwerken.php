<?php
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
    echo '<p>eventueel extra info</p>';
    echo '</header>'; //afsluiten header

// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
// Begin FORM
echo '<div id="frmDetail">';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : 'LEEG';
    switch ($action) {
        case "UpdateKlant":
            updateKlant();
            break;
        case "InsertKlant":
            insertKlant();
            break;
        case "InsertUser":
            insertUser();
            break;
        case "DeleteUser":
            deleteUser();
            break;
        case "UpdateUser":
            updateUser();
            break;
        case "LEEG":
        default:
            echo "geen geldige actie...";
    }
}
else {
    header('url=index.php');
}
    function updateKlant() {
        global $dbconn_pdo;
        $id=isset($_POST['klantnr']) ? $_POST['klantnr'] : 0;
        $klantnaam=isset($_POST['klantnaam']) ? addslashes($_POST['klantnaam']) : "";
        $contactpersoon=isset($_POST['contactpersoon']) ? addslashes($_POST['contactpersoon']) : "";
        $straat=isset($_POST['straat']) ? addslashes($_POST['straat']) : "";
        $huisnummer=isset($_POST['huisnummer']) ? $_POST['huisnummer'] : "";
        $postcode=isset($_POST['postcode']) ? $_POST['postcode'] : "";
        $plaats=isset($_POST['plaats']) ? addslashes($_POST['plaats']) : "";
        $telefoon=isset($_POST['telefoon']) ? $_POST['telefoon'] : "";
        $notitie=isset($_POST['notitie']) ? addslashes($_POST['notitie']) : "";
        $qryUpdateKlant="update Klant
                set naam='{$klantnaam}', cp='{$contactpersoon}', straat='{$straat}', huisnummer={$huisnummer}, postcode='{$postcode}', 
                    plaats='{$plaats}', telefoon='{$telefoon}', notitie='{$notitie}'
                    where id={$id}";
        $update=$dbconn_pdo->prepare($qryUpdateKlant);
        $update->execute();
//        if (mysqli_query($dbconn, $qryUpdateKlant)) {
        if ($update) {
            echo "<p>Klant {$klantnaam} ({$id}) is aangepast</p><br>";
            header('refresh: 1; url=klanten.php');
            exit();
        }
        else {
            echo "<p>Klant {$klantnaam} ({$id}) is NIET aangepast</p><br>";
            header('refresh: 10; url=klanten.php');
            exit();
        }

    }
    function insertKlant() {
        global $dbconn_pdo;
        $klantnaam=isset($_POST['klantnaam']) ? addslashes($_POST['klantnaam']) : "";
        $contactpersoon=isset($_POST['contactpersoon']) ? addslashes($_POST['contactpersoon']) : "";
        $straat=isset($_POST['straat']) ? addslashes($_POST['straat']) : "";
        $huisnummer=isset($_POST['huisnummer']) ? $_POST['huisnummer'] : "";
        $postcode=isset($_POST['postcode']) ? $_POST['postcode'] : "";
        $plaats=isset($_POST['plaats']) ? addslashes($_POST['plaats']) : "";
        $telefoon=isset($_POST['telefoon']) ? $_POST['telefoon'] : "";
        $notitie=isset($_POST['notitie']) ? addslashes($_POST['notitie']) : "";
        $qryInsertKlant= "insert into Klant
                        (naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie)
                        values('{$klantnaam}', '{$contactpersoon}', '{$straat}', {$huisnummer}, '{$postcode}',
                               '{$plaats}', '{$telefoon}', '{$notitie}')";
        $insert=$dbconn_pdo->prepare($qryInsertKlant);
        $insert->execute();
        if ($insert) {
            echo "<p>Klant {$klantnaam} is toegevoegd</p><br>";
            header('refresh: 1; url=klanten.php');
            exit();
        }
        else {
            echo "<p>Klant {$klantnaam} is NIET toegevoegd...</p><br>";
            header('refresh: 10; url=klanten.php');
            exit();
        }

    }
    function InsertUser(){
        global $dbconn_pdo;
        $inlognaam=isset($_POST['inlognaam']) ? $_POST['inlognaam'] : "";
        $wachtwoord=isset($_POST['wachtwoord']) ? addslashes($_POST['wachtwoord']) : "";
        $rol_id=isset($_POST['rol']) ? addslashes($_POST['rol']) : 0;
        $objUser = new User($dbconn_pdo);
        $rows=$objUser->insertUser($inlognaam, $wachtwoord, $rol_id);
        if ($rows==1) {
            echo "<p>Gebruiker {$inlognaam} is toegevoegd</p><br>";
            header('refresh: 1; url=gebruikers.php');
            exit();
        }
        else {
            echo "<p>Gebruiker {$inlognaam} is NIET toegevoegd...</p><br>";
            header('refresh: 10; url=gebruikers.php');
            exit();
        }
    }
    function updateUser()
    {
        global $dbconn_pdo;
        $id=isset($_POST['id']) ? $_POST['id'] : 0;
        $inlognaam=isset($_POST['inlognaam']) ? addslashes($_POST['inlognaam']) : "";
        $wachtwoord=isset($_POST['wachtwoord']) ? addslashes($_POST['wachtwoord']) : "";
        $role_id=isset($_POST['rol']) ? $_POST['rol'] : null;

        $userObj = new User($dbconn_pdo);
        $result = $userObj->editUser($id, $inlognaam, $wachtwoord, $role_id);

        if ($result) {
            echo "<p>Gebruiker {$inlognaam} ({$id}) is aangepast</p><br>";
            header('refresh: 1; url=gebruikers.php');
            exit();
        }
        else {
            echo "<p>Gebruiker {$inlognaam} ({$id}) is NIET aangepast</p><br>";
            header('refresh: 10; url=gebruikers.php');
            exit();
        }
    }
    function deleteUser() {
        global $dbconn_pdo;
        $id=isset($_POST['id']) ? $_POST['id'] : 0;
        $userObj = new User($dbconn_pdo);
        $result = $userObj->deleteUser($id);

        if ($result) {
            echo "<p>Gebruiker is verwijderd</p><br>";
            header('refresh: 1; url=gebruikers.php');
            exit();
        }
        else {
            echo "<p>Gebruiker is NIET verwijderd...</p><br>";
            header('refresh: 10; url=gebruikers.php');
            exit();
        }
}

?>


    FORMULIER

<?php
echo '</div>'; //frmDetail afsluiten
echo '</main>'; //main afsluiten 
include ("inc/footer.php") ;
?>