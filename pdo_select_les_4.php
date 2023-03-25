<?php
require_once 'inc/database_pdo.php';
include_once 'inc/config.php';

//query samenstellen
$query="SELECT id, naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie
        FROM Klant
        WHERE plaats= ? and postcode like ?
        ORDER BY naam, plaats 
        LIMIT 10;";
//query voorbereiden
$statement = $dbconn_pdo->prepare($query);
//variabelen voor parameters
$plaats="Amstelveen";
$postcode="1180%";
//binden parameter
$data = array($plaats, $postcode);
//query uitvoeren
$statement->execute($data);

//records in result wegschrijven (array!)
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
//array $result op scherm zetten
foreach ($result as $row) {
    echo 'Klantnaam: '.$row['naam']. ' Adres: '. $row['straat']. ' ' . $row['huisnummer'].' - ' . $row['plaats']. '<br>';
}

?><?php
