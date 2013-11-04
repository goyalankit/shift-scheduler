<?php

/*
 * Author: Ankit Goyal
 * Date: 10/23/2013
 *
 */

date_default_timezone_set('UTC');


/*
 * 
 * 
 * USER related methods
 * 
 * 
 */


function validateUser($uniqueId, $dbh) {
    $sql = "SELECT * FROM USER where UniqueId=:uniqueId";
    $sth = $dbh->prepare($sql);
    $data['uniqueId'] = trim($uniqueId);
    $success = $sth->execute($data);
    $details = $sth->fetchAll();
    return $details;
}

function enterScheduleForCandidate($username, $data, $dbh) {
    $weekNumber = date("W") + 1;
    $date = getFirstDayNextWeek();
    $dt = new DateTime($date);
    $day = strtolower($dt->format('l'));
    $year = strtolower($dt->format('Y'));

    $year_week = "" . $year . "" . $weekNumber;
    $shift_ids = array();

    foreach ($data as $key => $value) {
        $s = explode("_", $key);
        if ($s[1] == "shiftid") {
            $shift_ids[$s[0]] = $value;
            unset($data[$key]);
        }
    }

    $already_signed_up = getSignedUpShiftsForUser($username, $weekNumber, $dbh);
    
    $already_inserted_array = array();
    $final_insert_array = array();
    
    
    if (!empty($already_signed_up)) {
        foreach ($already_signed_up as $key => $value) {
            $already_inserted_array[$value["YearWeekDay"]] = true;
        }
    }

    
    foreach ($data as $key => $value) {
        $s = explode("_", $key);
        $year_week_date = "" . $year . "" . $weekNumber . "" . strtolower($s[0]);
        $shift_number = $shift_ids["shift" . ($s[1][1] + 1)];
        if(isset($final_insert_array[$year_week_date])){            
            array_push($final_insert_array[$year_week_date], $shift_number);            
        }
        else{
            $final_insert_array[$year_week_date] = array($shift_number);
        }        
    }

    
    
    foreach ($final_insert_array as $key => $value) {
        $data1['uniqueId'] = 'ankitg';
        $data1['ShiftIds'] = serialize($value);
        $data1['YearWeekDay'] = $key;
        $data1['YearWeek'] = $year_week;

        if (isset($already_inserted_array[$key])) {
            updateUserShift($data1, $dbh);
            unset($already_inserted_array[$key]);
        } else {
            insertUserShift($data1, $dbh);
        }
    }   
        
        
    foreach ($already_inserted_array as $key => $value) {
        $data2['uniqueId'] = 'ankitg';
        $data2['ShiftIds'] = serialize(array());
        $data2['YearWeekDay'] = $key;
        updateUserShift($data2, $dbh);        
    }
    
}

function updateUserShift($data, $dbh){    
    $sql = "UPDATE user_shifts set ShiftIds = '".$data["ShiftIds"]."' WHERE YearWeekDay='".$data["YearWeekDay"]."' and UserUniqueId='".$data["uniqueId"]."'";
    $sth = $dbh->prepare($sql);        
    $success = $sth->execute();
    if (!$success) {
        print_r($sth->errorInfo());
    }
}

function insertUserShift($data, $dbh){
    $sql = "INSERT INTO user_shifts (UserUniqueId, ShiftIds, YearWeekDay, YearWeek) VALUES(:uniqueId, :ShiftIds, :YearWeekDay, :YearWeek);";
    $sth = $dbh->prepare($sql);                        
    $success = $sth->execute($data);
}

function getSignedUpShiftsForUser($username, $week, $dbh){    
    $sql = "SELECT * FROM user_shifts where UserUniqueId=:uniqueId and YearWeek=:YearWeek";
    $year_week = date("Y")."".$week;    
    
    $sth = $dbh->prepare($sql);
    $data['uniqueId'] = $username;
    $data['YearWeek'] = $year_week;
        
    $success = $sth->execute($data);
    $details = $sth->fetchAll();        
    
    return $details;
}



/*
 * 
 * 
 * 
 * 
 * SHIFTS Management methods
 * 
 * 
 * 
 * 
 */

function addNewShift($values, $dbh) {
    date_default_timezone_set('UTC');            
    
    foreach ($values as $shiftNumber => $value) {                
        $data['shiftFrom'] = trim($value['from']);
        $data['shiftTo'] = trim($value['to']);
        $data['numberOfCandidates'] = trim($value['numberOfCandidates']);
        $data['active'] = 'true';
        
        if (isset($value['shiftId'])) {            
            updateShift($value['shiftId'], $data, $dbh);
            continue;
        }        
        
        $data['ShiftDate'] = getFirstDayNextWeek();
        if (!fourShiftsAlreadyPresentForDate($data['ShiftDate'], $dbh)) {
            $shiftId = insertShift($data, $dbh);
            addShiftToAvailableShifts($shiftId, $shiftNumber, $data['ShiftDate'], $dbh);
        }                
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
        //echo "entry exists in shifts available updating for " . ucfirst($shiftNumber) . " with shiftid =" . $shiftId . " <br/>";
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
    $sql = "UPDATE shift set ShiftFrom=:shiftFrom, ShiftTo=:shiftTo, NumberOfCandidates=:numberOfCandidates, Active=:active where ShiftId='".$shiftId."'";
    $sth = $dbh->prepare($sql);
    $date['ShiftNumber'] = $shiftId;
    $success = $sth->execute($data);
    return $dbh->lastInsertId();
}

function getShift($shiftId, $dbh) {
    $sql = "SELECT * FROM shift where ShiftId=:ShiftId";
    $sth = $dbh->prepare($sql);
    $data['ShiftId'] = $shiftId;
    $success = $sth->execute($data);
    $details = $sth->fetchAll();

    return $details;
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
                    $times[$j . "" . $i]["time"] = $shift[0]["ShiftFrom"] . "-" . $shift[0]["ShiftTo"];
                    $times[$j . "" . $i]["shiftid"] = $details[0]["Shift" . ($i + 1)];
                    
                }
            }
        }
    }
    return $times;
}

function shiftsForNextWeek($dbh){
    $weekNumber = date("W") + 1;
    $year = date('Y');
    $year_week = "" . $year . "" . $weekNumber;
    
    $sql = "SELECT * FROM shifts_available where YearWeek=:YearWeek";
    $sth = $dbh->prepare($sql);
    $data['YearWeek'] = $year_week;
    $success = $sth->execute($data);
    $details = $sth->fetchAll();
    
    $shifts = array();
    
    if (!empty($details)) {
        for ($i = 0; $i < 4; $i++) {
            if (!empty($details[0]["Shift" . ($i + 1)])) {
                $shifts["shift".($i+1)] = getShift($details[0]["Shift" . ($i + 1)], $dbh);            
            }
        }
    }
            
    return $shifts;
}



?>
