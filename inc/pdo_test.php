<?php

//initialiseren (geen wijzigingen...)
define('HOST', 'localhost');
define('DATABASE', 'transportbedrijf');
define('USER', 'root');
define('PASSWORD', 'H00rnb33ck');

$dbconn = '';
//connectie maken

try {
    //methode 1
    //$dbconn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";", USER, PASSWORD);
    //methode 2
    //$dbconn = new PDO("mysql:host=localhost;dbname=transportbedrijf;", "root", "H00rnb33ck"); //> werkt
    //methode met charset
    $dbconn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8mb4", USER, PASSWORD);


    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    echo "verbinding NIET gemaakt<br>";
}

// tot zover zou voldoende zijn... We gaan echter hier voor het gemak verder zodat het duidelijk wordt.
//Start gegevens ophalen m.b.v. PDO: query met placeholders maken: ?
$query = "SELECT id, naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie
        FROM Klant
        WHERE plaats=:woonplaats 
        ORDER BY naam, plaats
        LIMIT 5, 10;";
//Stap 2: Query voorbereiden...
$result = $dbconn->prepare($query);
//Stap 3: Placeholders koppelen met data
$result->bindParam(':woonplaats', $woonplaats);
$woonplaats = "Amstelveen"; //=>hier vul ik dus pas de variabele!

//Stap 4: Uitvoeren
echo '<h2>Inhoud klanten:</h2>';

try {
    $result->execute();
    $result->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        echo 'Klant: ' . $row['naam'] . ' -  ' . $row['plaats'] . '<br>';
    }
} catch (PDOException $e) {
    echo "foutje: " . $e->getMessage();
    echo "<script>alert('klanten niet gevonden');</script>";
}
?>

