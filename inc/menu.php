<?php
// controle ingelogd
include ('inc/check_login.php');
// ophalen rol gebruiker
$autRol=isset($_SESSION['rol']) ? strtolower($_SESSION['rol']) : '';
$inlognaam=isset($_SESSION['inlognaam']) ? $_SESSION['inlognaam'] : '';
// samenstellen menu
$menu='';
// op basis van rol menu tonen
switch ($autRol){
    case 'beheerder':
        $menu='<nav>
               <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="klanten.php">Klantgegevens</a></li>
                    <li><a href="#">Opdrachten</a></li>
                    <li>
                        <a href="gebruikers.php" class="dropbtn">Beheer</a>
                        <ul>
                            <li><a href="gebruikers.php">Nieuwe gebruiker</a></li>
                            <li><a href="#">Wijzigen gebruiker</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="uitloggen.php">Uitloggen</a></li>
                </ul>
              </nav>';
        break;
    case 'administratie':
        $menu='<nav>
               <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="klanten.php">Klantgegevens</a></li>
                    <li><a href="#">Opdrachten</a></li>
                     <li><a href="#">Contact</a></li>
                    <li><a href="uitloggen.php">Uitloggen</a></li>
                </ul>
               </nav>';
        break;
    case 'planner':
        $menu='<nav>
               <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="klanten.php">Klantgegevens</a></li>
                    <li><a href="#">Opdrachten</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="uitloggen.php">Uitloggen</a></li>
                </ul>
               </nav>';
        break;
    case 'klantrelaties':
        $menu='<nav>
               <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="klanten.php">Klantgegevens</a></li>
                    <li><a href="#">Opdrachten</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="uitloggen.php">Uitloggen</a></li>
                </ul>
               </nav>';
        break;
    default:
        $menu='';
}

echo $menu;

?>

