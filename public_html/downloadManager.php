<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");

$link = getShiftData($_POST['WeekNumber'], $dbh);
renderLayoutWithContentFile("downloadPage.php", array($link));
?>    


