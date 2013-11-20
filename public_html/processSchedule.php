<?php
/* Author: Ankit Goyal
 * Date: 10/23/2013
 *
 *  Process the schedule responses. Display the final schedule for a candidate.
 * 
 */

session_start();
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");


enterScheduleForCandidate($_SESSION["uniqueId"], $_POST, $dbh);

header('Location: /public_html/showSchedule.php');       
//if processing was successfil. Render the final schedule and show it to candidate.

?>
