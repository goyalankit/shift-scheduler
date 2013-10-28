<?php
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");



$shift_data = array();

for ($i = 0; $i < 5; $i++) {
    if(isset($_POST['shift'.$i.'_active']) == 'on'){
       date_default_timezone_set('UTC');
       $shift_data["shift".$i]["from"] = $_POST['shift'.$i.'_from'];
       $time = strtotime($_POST['shift'.$i.'_from']);
       $newformat = date('Y-m-d H:i:s', $time);       
       echo $newformat;
       echo "<br/>";
       $shift_data["shift".$i]["to"] = $_POST['shift'.$i.'_to'];
       $shift_data["shift".$i]["numberOfCandidates"] = $_POST['shift'.$i.'_numberOfCandidates'];      
    }    
}

//print_r($shift_data);
addNewShift($shift_data, $dbh);


?>
