
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

$isAdmin = $_SESSION['isadmin'];

session_destroy(); 

if($isAdmin != "true")
    header('Location:/public_html/');
else
    header('Location:/public_html/admin');
?>

