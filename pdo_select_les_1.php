<?php

//require_once 'inc/database.php';
require_once 'inc/database_pdo.php';
include_once 'inc/config.php';

//query samenstellen
$query="SELECT id, naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie
        FROM Klant
        WHERE plaats='Amstelveen'
        ORDER BY naam, plaats 
        LIMIT 10, 13;";
//query voorbereiden
$statement = $dbconn_pdo->prepare($query);
//query uitvoeren
$statement->execute();
//records in result wegschrijven (array!)
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
//array $result op scherm zetten
foreach ($result as $row) {
    echo 'Klantnaam: '.$row['naam']. ' Adres: '. $row['straat']. ' ' . $row['huisnummer'].' - ' . $row['plaats']. '<br>';
}