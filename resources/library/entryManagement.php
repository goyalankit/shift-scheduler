<?php

/*
 * Author: Ankit Goyal
 * Date: 10/23/2013
 *
 */

function validateUser($uniqueId, $dbh){
    $sql = "SELECT * FROM USER where UniqueId=:uniqueId";
    $sth = $dbh -> prepare($sql);
    $data['uniqueId'] = trim($uniqueId);
    $success = $sth -> execute($data);  
    $details = $sth -> fetchAll();    
    return $details;
}

function addNewShift($values, $dbh){    
    date_default_timezone_set('UTC');        
            
    foreach ($values as $value) {        
        $data['shiftFrom'] = trim($value['from']);
        $data['shiftTo'] = trim($value['to']);
        $data['numberOfCandidates'] = trim($value['numberOfCandidates']);
        $data['active'] = 'true';        
                
        $data['ShiftDate'] = getFirstDayNextWeek();
        insertShift($data, $dbh);
        for($i=0; $i<7 ;$i++){
            echo "inserting <br/>";            
            $data['ShiftDate'] = getNextDay($data['ShiftDate']);
            if(fourShiftsAlreadyPresentForDate($data['ShiftDate'], $dbh)){                                
                echo "You have exceeded the maximum allowed number of shifts.";
            }else{                
                $shiftId = insertShift($data, $dbh);
                addShiftToSchedule($shiftId, $dbh);
            }
        }
        
        echo "<br/>";
      }
    }
       
    
   function addShiftToSchedule($shiftId, $dbh){       
    //TODO    
   } 
    
   function fourShiftsAlreadyPresentForDate($date, $dbh){
    $sql = "SELECT * FROM SHIFT where ShiftDate=:ShiftDate";
    $sth = $dbh -> prepare($sql);
    $data['ShiftDate'] = $date;
    $success = $sth -> execute($data);  
    $details = $sth -> fetchAll();       
    return count($details) > 4;
   }
    
   function insertShift($data, $dbh){
       $sql = "INSERT INTO SHIFT (ShiftFrom, ShiftTo, NumberOfCandidates, Active, ShiftDate) VALUES(:shiftFrom, :shiftTo, :numberOfCandidates, :active, :ShiftDate);";    
       $sth = $dbh->prepare($sql);
       $success = $sth->execute($data);
       return $dbh -> lastInsertId();       
   }
    
    
  function getFirstDayNextWeek(){
        date_default_timezone_set('UTC');
        $weekNumber = date("W") + 1;
        $week_start = new DateTime();
        $week_start->setISODate(2013,$weekNumber);
        return $week_start->format('Y-m-d');
    }
    
    function getNextDay($date) {        
        date_default_timezone_set('UTC');
        return date('Y-m-d', strtotime('+1 day', strtotime($date)));
    }		

?>
