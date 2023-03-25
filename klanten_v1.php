<?php
// include database.php
require_once 'inc/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Klantgegevens</title>
    <!-- hier komen de css-bestanden -->
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<!-- voor de opmaak straks zetten we alles in een container… -->
<div class="container">
    <?php
    // include menu
    include('inc/menu.php');
    // header tags toevoegen
    echo '<header class="head">';
    // hier komt straks een url om een nieuwe klant aan te maken…

    echo '</header>'; //afsluiten header
    // voor gridopmaak alvast de main-content
    echo '<main class="main-content">';
    ?>
    <!-- tabelkop met klantgegevens als HTML-->
    <table id="customers">
        <tr>
            <th>klantnr</th>
            <th>klantnaam</th>
            <th>contactpersoon</th>
            <th>straat</th>
            <th>huisnummer</th>
            <th>postcode</th>
            <th>plaats</th>
            <th>telefoon</th>
            <th>actie</th>
        </tr>
        <?php
        // ophalen klantgegevens uit database
        $query="SELECT id, naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie
        FROM Klant
        ORDER BY naam, plaats
        LIMIT 1, 20;";
        //$resultaat bepalen....
        $result=mysqli_query($dbconn, $query);
        //aantal records bepalen....
        $aantal=mysqli_num_rows($result);
        $contentTable="";
        // tabel aanvullen met klantgegevens
        if ($aantal>0){ //controle of er wel wat opgehaald wordt...
            while ($row=mysqli_fetch_array($result)) {
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
        // paginering van de tabel

        // include footer

        echo '</main>';
        ?>

</div>
</body>
</html>