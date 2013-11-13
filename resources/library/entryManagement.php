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
    $week = date("W") + 1;            
    
    $shift_ids = array();
    foreach ($data as $key => $value) {
        $s = explode("_", $key);
        if ($s[1] == "shiftid") {
            $shift_ids[$s[0]] = $value;
            unset($data[$key]);
        }
    }    
    unset($s);
        
    //Deactivating all the shifts for that week
    $previous_shifts = deactivateShifts($username, $week, date('Y'), $dbh);    

    foreach ($data as $shift => $shiftId) {
        $data1 = array();
        $s = explode("_", $shift);
        $data1["Day"] = $s[0];
        $data1["shiftNumber"] = $s[1] + 1;                        
        $data1["ShiftDate"] = date('Y-m-d', strtotime("next week ".$s[0]));            
        $data1["Year"] = date('Y');
        $data1["Week"] = $week;            
        $data1["uniqueId"] = $username;
        if(checkIfShiftAlreadyExists($data1, $dbh)){                
                makeShiftActive($data1, $dbh);      
                continue;
        }
        $data1["ShiftId"] = $shift_ids["shift".($s[1]+1)];            
        insertUserShift($data1, $dbh);
    }           
}

function deactivateShifts($username, $week, $year, $dbh){
    $sql = "UPDATE user_shifts set active='false' where UserUniqueId='".$username."' and Week='".$week."' and Year='".$year."'";
    $sth = $dbh->prepare($sql);
    $success = $sth->execute();
    $details = $sth->fetchAll();  
}

function makeShiftActive($data, $dbh){
    $sql = "UPDATE user_shifts set active='true' where UserUniqueId=:uniqueId and Week=:Week and Year=:Year and ShiftNumber=:shiftNumber and Day=:Day and ShiftDate=:ShiftDate";
    $sth = $dbh->prepare($sql);
    $success = $sth->execute($data);
    $details = $sth->fetchAll();  
    
}

function checkIfShiftAlreadyExists($data, $dbh){
    $sql = "SELECT * FROM user_shifts where UserUniqueId=:uniqueId and Week=:Week and Year=:Year and ShiftNumber=:shiftNumber and Day=:Day and ShiftDate=:ShiftDate";
    $sth = $dbh->prepare($sql);
    $success = $sth->execute($data);
    $details = $sth->fetchAll();  
    if(empty($details))
        return false;
    else
        return true;
}

function getShiftsForUser($username, $week, $year, $dbh){
    $sql = "SELECT * FROM user_shifts where UserUniqueId=:uniqueId and Week=:Week and Year=:Year";
    
    $data['uniqueId'] = $username;
    $data['Year'] = $year;
    $data['Week'] = $week;
    
    $sth = $dbh->prepare($sql);
    $success = $sth->execute($data);
    $details = $sth->fetchAll();

    return $details;     
}

function insertUserShift($data, $dbh) {
    $sql = "INSERT INTO user_shifts (UserUniqueId, ShiftId, ShiftNumber, Year, Week, Day, ShiftDate) VALUES(:uniqueId, :ShiftId, :shiftNumber, :Year, :Week, :Day, :ShiftDate);";
    $sth = $dbh->prepare($sql);
    $success = $sth->execute($data);
   if (!$success) {
      print_r($sth->errorInfo());
    }    
    
}

function updateUserShift($data, $dbh) {
    $sql = "UPDATE user_shifts set ShiftIds = '" . $data["ShiftIds"] . "' WHERE YearWeekDay='" . $data["YearWeekDay"] . "' and UserUniqueId='" . $data["uniqueId"] . "'";
    $sth = $dbh->prepare($sql);
    $success = $sth->execute();
    if (!$success) {
        print_r($sth->errorInfo());
    }
}


function getSignedUpShiftsForUser($username, $week, $year, $dbh) {
    $sql = "SELECT usht.ShiftNumber, usht.ShiftDate, usht.Day, sht.ShiftFrom, sht.ShiftTo FROM user_shifts as usht JOIN shift as sht on (sht.ShiftId = usht.ShiftId) where Week=:Week and Year=:Year and usht.active='true' and UserUniqueId=:uniqueId ORDER BY usht.ShiftDate;";
    
    $sth = $dbh->prepare($sql);
    $data['uniqueId'] = $username;
    $data['Year'] = $year;
    $data['Week'] = $week;

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
            addShiftToAvailableShiftsNew($shiftId, $shiftNumber, $data['ShiftDate'], $dbh);
        }
    }
}

function addShiftToAvailableShiftsNew($shiftId, $shiftNumber, $date, $dbh) {
    $weekNumber = date("W") + 1;
    $date = getFirstDayNextWeek();
    $dt = new DateTime($date);
    $day = strtolower($dt->format('l'));
    $year = strtolower($dt->format('Y'));
    
    $sql = "INSERT INTO shift_dates (ShiftDate, ShiftId, Week, Day, ShiftNumber, Year) VALUES(:ShiftDate, :ShiftId, :Week, :Day, :ShiftNumber, :Year);";
        
    $sth = $dbh->prepare($sql);
    $data['ShiftDate'] = $date;
    $data['ShiftId'] = $shiftId;
    $data['Week'] = $weekNumber;
    $data['Day'] = $day;    
    $data['Year'] = $year;
    preg_match_all('!\d!', $shiftNumber, $matches);    
    $data['ShiftNumber'] = $matches[0][0];
    $success = $sth->execute($data);    
    if (!$success) {
      print_r($sth->errorInfo());
    }
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
    $sql = "UPDATE shift set ShiftFrom=:shiftFrom, ShiftTo=:shiftTo, NumberOfCandidates=:numberOfCandidates, Active=:active where ShiftId='" . $shiftId . "'";
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


function shiftsForWeek($dbh, $weekNumber, $year) {         
    $sql = "select * from shift_dates as sd LEFT JOIN shift as s on (sd.Week=:Week and sd.Year=:Year and sd.ShiftId = s.ShiftId);";
    $sth = $dbh->prepare($sql);
    $data['Week'] = $weekNumber;
    $data['Year'] = $year;
    
    $success = $sth->execute($data);
    $details = $sth->fetchAll();                
    
    $shift_details = array();    
    if(!empty($details)){        
        foreach ($details as $key => $value) {                                                                        
            $shift_details["shift".$value["ShiftNumber"]]["ShiftId"] = $value["ShiftId"];
            $shift_details["shift".$value["ShiftNumber"]]["ShiftFrom"] = $value["ShiftFrom"];
            $shift_details["shift".$value["ShiftNumber"]]["ShiftTo"] = $value["ShiftTo"];
            $shift_details["shift".$value["ShiftNumber"]]["NumberOfCandidates"] = $value["NumberOfCandidates"];                                
        }        
    }
    
    return $shift_details;
}
?>
