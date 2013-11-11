<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");

$variables = shiftsForWeek($dbh, date("W") + 1, 2013);

renderLayoutWithContentFile("schedule.php", $variables);
?>
