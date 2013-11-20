<?php
/* Author: Ankit Goyal
 * Date: 11/04/2013
 *
 *  Process the schedule responses. Display the final schedule for a candidate.
 * 
 */

session_start();

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");




$variables = getSignedUpShiftsForUser($_SESSION['uniqueId'], date("W") + 1, date('Y'), $dbh);

renderLayoutWithContentFile("finalScheduleForCandidate.php", $variables);
?>
