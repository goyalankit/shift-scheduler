
<?php

session_start();

$isAdmin = $_SESSION['isadmin'];

session_destroy();

if ($isAdmin != "true")
    header('Location:/public_html/');
else
    header('Location:/public_html/admin');
?>

