<?php
/* Author: Ankit Goyal
 * Date: 11/04/2013
 *
 *  Process the schedule responses. Display the final schedule for a candidate.
 * 
 */

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");




$variables = getSignedUpShiftsForUser("ankitg", date("W") + 1, $dbh);

$shift_details = array();

foreach ($variables as $key => $value) {
    $replaced = str_replace($value["YearWeek"],"" ,$value["YearWeekDay"]);        
    
    if(!isset($shift_details[$replaced])){                      
        $shift_details[$replaced] = unserialize($value["ShiftIds"]);     
    }    
}

$final_values = getTimeForUserShifts($shift_details, $dbh);

renderLayoutWithContentFile("finalScheduleForCandidate.php", $final_values);
?>
