<?php

session_start();

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");


if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == "true") {
    renderLayoutWithContentFile("adminHome.php");
    return;
} else if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Location: /public_html/admin');
}

$username = $_POST['username'];
$password = $_POST['password'];

$isadmin = verify_admin($dbh, $username, $password);
if ($isadmin == "true") {
    $_SESSION['isadmin'] = "true";
    renderLayoutWithContentFile("adminHome.php");
} else {
    header('Location: /public_html/admin');
}
?>
