<?php
include("inc/header.php");
//error_reporting(0);

if ($_POST['submit']) {
    $inlognaam=isset($_POST['inlognaam']) ? $_POST['inlognaam'] : '';
    $wachtwoord=isset($_POST['wachtwoord']) ? $_POST['wachtwoord'] : '';
}
else {
    header('refresh: 1, index.php');
}
//selectquery opbouwen. neem daarin al de inlognaam en wachtwoord mee!;
$query="SELECT gebruiker.id, gebruiker.inlognaam, gebruiker.wachtwoord, rol.naam FROM gebruiker
INNER JOIN rol ON gebruiker.rol_id=rol.id
where inlognaam='".$inlognaam."' and wachtwoord='".$wachtwoord."';";
echo $query.'<br>';
//$resultaat bepa   len....
$result=mysqli_query($dbconn, $query);

//aantal records bepalen....
$aantal=mysqli_num_rows($result);
if ($aantal==1){ //let op dubbele ==
while ($row=mysqli_fetch_array($result)) {
$rol=$row['naam'];
}
$_SESSION['inlognaam']=$inlognaam;
$_SESSION['wachtwoord']=$wachtwoord;
$_SESSION['rol']=$rol;
$_SESSION['ingelogd']=true;
header('refresh: 1; url=klanten.php');
exit;
}
else {
echo 'Helaas, uw inlognaam en/of wachtwoord corresponderen niet met onze gegevens. U wordt
doorgestuurd...<br>';
session_destroy();
session_unset();
//sluiten db-connectie
mysqli_close($dbconn);
header('refresh: 5; url=login.php');
exit;
}
include("inc\footer.php");
?>