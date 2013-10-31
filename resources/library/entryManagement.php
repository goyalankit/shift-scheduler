<?php

/*
 * Author: Ankit Goyal
 * Date: 10/23/2013
 *
 */

date_default_timezone_set('UTC');

function validateUser($uniqueId, $dbh) {
    $sql = "SELECT * FROM USER where UniqueId=:uniqueId";
    $sth = $dbh->prepare($sql);
    $data['uniqueId'] = trim($uniqueId);
    $success = $sth->execute($data);
    $details = $sth->fetchAll();
    return $details;
}

function addNewShift($values, $dbh) {
    date_default_timezone_set('UTC');

    foreach ($values as $shiftNumber => $value) {
        $data['shiftFrom'] = trim($value['from']);
        $data['shiftTo'] = trim($value['to']);
        $data['numberOfCandidates'] = trim($value['numberOfCandidates']);
        $data['active'] = 'true';

        if (isset($value['shiftId'])) {
            updateShift($value['shiftId'], $data, $dbh);
            break;
        }


        $data['ShiftDate'] = getFirstDayNextWeek();
        if (!fourShiftsAlreadyPresentForDate($data['ShiftDate'], $dbh)) {
            $shiftId = insertShift($data, $dbh);
            addShiftToAvailableShifts($shiftId, $shiftNumber, $data['ShiftDate'], $dbh);
        }

        for ($i = 0; $i < 6; $i++) {
            $data['ShiftDate'] = getNextDay($data['ShiftDate']);
            if (fourShiftsAlreadyPresentForDate($data['ShiftDate'], $dbh)) {
                echo "You have exceeded the maximum allowed number of shifts.";
            } else {
                $shiftId = insertShift($data, $dbh);
                echo "shift id: " . $shiftId;
                addShiftToAvailableShifts($shiftId, $shiftNumber, $data['ShiftDate'], $dbh);
            }
        }

        echo "<br/>";
    }
}

function addShiftToAvailableShifts($shiftId, $shiftNumber, $date, $dbh) {
    $weekNumber = date("W") + 1;
    $dt = new DateTime($date);
    $day = strtolower($dt->format('l'));
    $year = strtolower($dt->format('Y'));
    $year_week_date = "" . $year . "" . $weekNumber . "" . $day;
    $year_week = "" . $year . "" . $weekNumber;
    $entryIfExists = entryExistsForWeekInShiftsAvailable($year_week_date, $dbh);
    if (empty($entryIfExists)) {
        $sql = "INSERT INTO shifts_available (YearWeekDay, YearWeek, " . ucfirst($shiftNumber) . ") VALUES(:YearWeekDay, :YearWeek, :ShiftNumber);";
        $sth = $dbh->prepare($sql);
        $data['YearWeekDay'] = $year_week_date;
        $data['ShiftNumber'] = $shiftId;
        $data['YearWeek'] = $year_week;
        $success = $sth->execute($data);
    } else {
        echo "entry exists in shifts available updating for " . ucfirst($shiftNumber) . " with shiftid =" . $shiftId . " <br/>";
        $sql = "UPDATE shifts_available set " . ucfirst($shiftNumber) . "='" . $shiftId . "' WHERE YearWeekDay='" . $year_week_date . "'";
        $sth = $dbh->prepare($sql);
        //$data['ShiftNumber'] = $shiftId;
        $success = $sth->execute();
        if (!$success) {
            print_r($sth->errorInfo());
        }
    }
}

function entryExistsForWeekInShiftsAvailable($year_week_date, $dbh) {
    $sql = "SELECT * FROM shifts_available where YearWeekDay=:YearWeekDay";
    $sth = $dbh->prepare($sql);
    $data['YearWeekDay'] = $year_week_date;
    $success = $sth->execute($data);
    $details = $sth->fetchAll();
    return $details;
}

function fourShiftsAlreadyPresentForDate($date, $dbh) {
    $sql = "SELECT * FROM SHIFT where ShiftDate=:ShiftDate";
    $sth = $dbh->prepare($sql);
    $data['ShiftDate'] = $date;
    $success = $sth->execute($data);
    $details = $sth->fetchAll();
    return count($details) > 3;
}

function insertShift($data, $dbh) {
    $sql = "INSERT INTO SHIFT (ShiftFrom, ShiftTo, NumberOfCandidates, Active, ShiftDate) VALUES(:shiftFrom, :shiftTo, :numberOfCandidates, :active, :ShiftDate);";
    $sth = $dbh->prepare($sql);
    $success = $sth->execute($data);
    return $dbh->lastInsertId();
}

function updateShift($shiftId, $data, $dbh) {
    //SHIFT (ShiftFrom, ShiftTo, NumberOfCandidates, Active, ShiftDate) VALUES(:shiftFrom, :shiftTo, :numberOfCandidates, :active, :ShiftDate);
    $sql = "UPDATE shift set ShiftFrom=:shiftFrom, ShiftTo=:shiftTo, NumberOfCandidates=:numberOfCandidates, Active=:active";
    $sth = $dbh->prepare($sql);
    $date['ShiftNumber'] = $shifId;
    $success = $sth->execute($data);
    return $dbh->lastInsertId();
}

function getFirstDayNextWeek() {
    date_default_timezone_set('UTC');
    $weekNumber = date("W") + 1;
    $week_start = new DateTime();
    $week_start->setISODate(2013, $weekNumber);
    return $week_start->format('Y-m-d');
}

function getNextDay($date) {
    date_default_timezone_set('UTC');
    return date('Y-m-d', strtotime('+1 day', strtotime($date)));
}

function getAvailableShiftsForCurrentWeek($dbh) {
    $weekNumber = date("W") + 1;
    $year = date('Y');
    $year_week = "" . $year . "" . $weekNumber;

    $sql = "SELECT * FROM shifts_available where YearWeek=:YearWeek";
    $sth = $dbh->prepare($sql);
    $data['YearWeek'] = $year_week;
    $success = $sth->execute($data);
    $details = $sth->fetchAll();

    $times = array();

    if (!empty($details)) {
        for ($i = 0; $i < 4; $i++) {
            if (!empty($details[0]["Shift" . ($i + 1)])) {
                $shift = getShift($details[0]["Shift" . ($i + 1)], $dbh);
                for ($j = 0; $j < 7; $j++) {
                    $times[$j . "" . $i] = $shift[0]["ShiftFrom"] . "-" . $shift[0]["ShiftTo"];
                }
            }
        }
    }
    return $times;
}

function getShift($shiftId, $dbh) {
    $sql = "SELECT * FROM shift where ShiftId=:ShiftId";
    $sth = $dbh->prepare($sql);
    $data['ShiftId'] = $shiftId;
    $success = $sth->execute($data);
    $details = $sth->fetchAll();

    return $details;
}

?>
