<?php


session_start();

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");

if(!isset($_SESSION['uniqueId'])){
    header('Location: /public_html/');
}


renderLayoutWithContentFile("user.php");
?>
