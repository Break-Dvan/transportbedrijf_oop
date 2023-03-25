<?php
require_once 'inc/database.php';
require_once 'inc/database_pdo.php';

$sql_count = "SELECT count(id) as aantal FROM Klant;";
//$res_count = mysqli_query($dbconn, $sql_count);
$stmt = $dbconn_pdo->prepare($sql_count);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo 'Aantal: '.$row['aantal'].'<br>';




////$row = mysqli_fetch_assoc($res_count);
//foreach($res_count as $total_rows) {
//    $total_rows = $res_count['aantal'];
//}
//echo "Totaal: ".$total_rows.'<br>';


?>