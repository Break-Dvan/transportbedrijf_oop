<?php

require_once 'inc/database.php';
require_once 'inc/database_pdo.php';
include_once 'inc/config.php';

//query samenstellen
$query="SELECT id, naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie
        FROM Klant
        WHERE plaats= ?
        ORDER BY naam, plaats 
        LIMIT 1, 13;";
//query voorbereiden
$statement = $dbconn_pdo->prepare($query);
//bind parameters
$plaats="Duivendrecht";
//binden parameter
$statement->bindParam(1,$plaats); //alleen variabelen!
//query uitvoeren
$statement->execute();

//records in result wegschrijven (array!)
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
//array $result op scherm zetten
foreach ($result as $row) {
    echo 'Klantnaam: '.$row['naam']. ' Adres: '. $row['straat']. ' ' . $row['huisnummer'].' - ' . $row['plaats']. '<br>';
}
//bind parameters
$plaats="Amstelveen";
//query uitvoeren
$statement->execute();
//records in result wegschrijven (array!)
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    echo 'Klantnaam: '.$row['naam']. ' Adres: '. $row['straat']. ' ' . $row['huisnummer'].' - ' . $row['plaats']. '<br>';
}
?>
