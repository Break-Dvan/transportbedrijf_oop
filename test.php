<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
</head>
<body>
<?php
echo dirname($_SERVER['PHP_SELF']);
echo '<br>';
echo $_SERVER['PHP_SELF'];
$file = str_replace(dirname($_SERVER['PHP_SELF']).'/','',$_SERVER['PHP_SELF'] );
echo '<br>';
echo $file.'<br>';

if ($file!='test.php') {
    echo 'test.php!<br>';
}
else {
    echo 'onbekend<br>';
}
?>

</body>
</html>

