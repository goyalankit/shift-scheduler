<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");

$variables["available"] = getAvailableShiftsForCurrentWeek($dbh);
$signed_up = getSignedUpShiftsForUser("ankitg", date("W") + 1, $dbh);

function processSignedUpShiftsForUser($signed_up) {
    $weekdays = array(0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
        4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');

    $has_selected = array();

    foreach ($signed_up as $key => $value) {
        foreach ($weekdays as $week_number => $week) {
            if (strpos($value["YearWeekDay"], strtolower($week)) !== false) {

                $shift_ids = unserialize($value["ShiftIds"]);
                foreach ($shift_ids as $shift_value) {
                    $has_selected[$week_number . $shift_value] = "true";
                }
            }
        }
    }
    
    return $has_selected;
}

$variables["signed_up"] = processSignedUpShiftsForUser($signed_up);
renderLayoutWithContentFile("schedule.php", $variables);
?>
