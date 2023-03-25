<?php
//initialiseren (geen wijzigingen...)
//Zolang database.php nog geladen wordt in header.php even uitzetten...
//define('HOST', 'localhost');
//define('DATABASE', 'transportbedrijf');
//define('USER', 'webuser');
//define('PASSWORD','7q06DXjDr1Z3reXK');

$dbconn_pdo='';
//connectie maken

try {
    //methode 1
    //$dbconn_pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";", USER,PASSWORD);
    //methode 2
    //$dbconn_pdo = new PDO("mysql:host=localhost;dbname=transportbedrijf;", "root","H00rnb33ck"); //> werkt
    //methode met charset
    $dbconn_pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8mb4", USER,PASSWORD);


    $dbconn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo $e->getMessage();
    echo "verbinding NIET gemaakt<br>";
}

