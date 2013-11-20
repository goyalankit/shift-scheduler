<?php

session_start();

if(!isset($_SESSION['uniqueId'])){
    header('Location: /public_html/');
}

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");

$variables = shiftsForWeek($dbh, date("W") + 1, 2013);
$user_shifts = getShiftsForUser($_SESSION["uniqueId"],  date("W") + 1, 2013, $dbh);
$day_shiftn = array();
foreach ($user_shifts as $key => $value) {
    $day_shiftn[$value["Day"]] = $value["ShiftNumber"];
}

$variables["day_shiftn"] = $day_shiftn;
renderLayoutWithContentFile("schedule.php", $variables);
?>
