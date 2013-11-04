<?php
/* Author: Ankit Goyal
 * Date: 10/23/2013
 *
 *  Process the schedule responses. Display the final schedule for a candidate.
 * 
 */

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");


enterScheduleForCandidate("ankitg", $_POST, $dbh);

//if processing was successfil. Render the final schedule and show it to candidate.
renderLayoutWithContentFile("finalScheduleForCandidate.php", $_POST);
?>
