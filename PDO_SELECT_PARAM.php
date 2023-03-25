<?php
require_once 'inc/database.php';
require_once 'inc/database_pdo.php';
include_once 'inc/config.php';

// ophalen klantgegevens uit database
$query="SELECT id, naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie
        FROM Klant
        WHERE plaats= ?
        ORDER BY naam, plaats ";
//        LIMIT ? , ?;";
$start_from=10;
$limit = "LIMIT $start_from, " . RECORDS_PER_PAGE. ";";
// LET OP: LIMIT X, Y als string toevoegen aan $query... StackOverflow...
$query .= $limit;
echo $query;
$result = $dbconn_pdo->prepare($query);
//bind parameters
$plaats="Amstelveen";
$iAantal=10;
$result->bindParam(1,$plaats); //alleen variabelen!
//$result->bindParam(2,$iAantal); //alleen variabelen!
$result->execute();
//$aWhere = array("Amstelveen");
$result->setFetchMode(PDO::FETCH_ASSOC );
$aantal=$result->rowCount();
$contentTable="";
// tabel aanvullen met klantgegevens
if ($aantal>0){ //controle of er wel wat opgehaald wordt...
    while ($row=$result->fetch()) {
        $contentTable.="<tr>
                            <td>".$row['id']."</td>                       
                            <td>".$row['naam']."</td>                       
                            <td>".$row['cp']."</td>                       
                            <td>".$row['straat']."</td>                       
                            <td>".$row['huisnummer']."</td>                       
                            <td>".$row['postcode']."</td>                      
                            <td>".$row['plaats']."</td>                      
                            <td>".$row['telefoon']."</td>
                            <!--<td>".$row['notitie']."</td>-->
                            <td>
                                <a href='klant_edit.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='klant_delete.php?id={$row['id']}' class='btn-delete'><i class='material-icons md-24'>delete</i></a>
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

?>