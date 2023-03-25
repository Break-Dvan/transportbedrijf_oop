<?php
// include header.php
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
// hier komt straks een url om een nieuwe klant aan te maken…
echo "<a href='gebruiker_new.php' class='btn-new'><i class='material-icons md-24'>add</i></a>";
echo '</header>'; //afsluiten header
// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
?>
    <!-- tabelkop met klantgegevens als HTML-->
    <table id="users">
        <tr>
            <th>id</th>
            <th>inlognaam</th>
            <th>wachtwoord</th>
            <th>rol_id</th>
            <th>rol</th>
        </tr>
<?php
//bepaling 'page' voor paginering
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
else {
    $page=1;
}
//start vanaf
$start_from = ($page-1) * RECORDS_PER_PAGE;
//object maken...OOP User.class...
$objUser = new User($dbconn_pdo);
//aantal pagina's bepalen t.b.v. paginering
$total_rows=$objUser->countUsers(); // aanroep countUsers() | berekening totaal pagina's
$total_pages = ceil($total_rows / RECORDS_PER_PAGE);
//$qryLimit = "LIMIT " .$start_from.",". RECORDS_PER_PAGE.";"; // parameters werken niet binnen de LIMIT-optie
//$resultaat bepalen....
$contentTable="";
// tabel aanvullen met klantgegevens
$gebruikers = $objUser->readAll($start_from, RECORDS_PER_PAGE);
$gebruikers->setFetchMode(PDO::FETCH_ASSOC );
$iGebruikers = $gebruikers->rowCount();
if ($iGebruikers>0) {
    foreach ($gebruikers as $gebruiker) {
        $contentTable.="<tr>
                            <td>".$gebruiker['id']."</td>                       
                            <td>".$gebruiker['inlognaam']."</td>                       
                            <td>".$gebruiker['wachtwoord']."</td>                       
                            <td>".$gebruiker['rol_id']."</td>                       
                            <td>".$gebruiker['rol']."</td>                       
                            <td>
                                <a href='gebruiker_edit.php?id={$gebruiker['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='gebruiker_delete.php?id={$gebruiker['id']}' class='btn-delete'><i class='material-icons md-24'>delete</i></a>
                            </td>
                        </tr>";
    }
}
else {
    $contentTable='<tr>
                        <td colspan="9">Geen gegevens om op te halen...</td>
                    </tr>';
}
// weergave van de rest van de tabel;
$contentTable.='</table><br>';
echo $contentTable;
// paginering van de tabel
$page_url="gebruikers.php";
include_once 'inc/paginering.php';
// include footer
echo '</div>'; //frmDetail afsluiten
echo '</main>'; //main afsluiten
include ("inc/footer.php");
?>