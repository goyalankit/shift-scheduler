<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");



$shift_data = array();

//print_r($_POST);

for ($i = 0; $i < 5; $i++) {
    if (isset($_POST['shift' . $i . '_active']) == 'on') {
        date_default_timezone_set('UTC');
        if (isset($_POST['shift' . $i . '_shiftid']) && $_POST['shift' . $i . '_shiftid'] != "") {
            $shift_data["shift" . $i]["shiftId"] = $_POST['shift' . $i . '_shiftid'];
        }

        $shift_data["shift" . $i]["from"] = $_POST['shift' . $i . '_from'];
        $time = strtotime($_POST['shift' . $i . '_from']);
        $newformat = date('Y-m-d H:i:s', $time);
        echo "<br/>";
        $shift_data["shift" . $i]["to"] = $_POST['shift' . $i . '_to'];
        $shift_data["shift" . $i]["numberOfCandidates"] = $_POST['shift' . $i . '_numberOfCandidates'];                
        $shift_data["shift" . $i]["days"] = preg_grep_keys("/shift".$i."_days_.*/", $_POST);           
        $shift_data["shift" . $i]["ShiftIds"] = preg_grep_key_value("/shift".$i."_shiftid_.*/", $_POST);                   
    }
    
}

function preg_grep_keys( $pattern, $input, $flags = 0 )
{
    
    $keys = preg_grep( $pattern, array_keys( $input ), $flags );
    $vals = array();
    foreach ( $keys as $key )
    {        
        array_push($vals, $input[$key]);
    }
    return $vals;
}

function preg_grep_key_value( $pattern, $input, $flags = 0 )
{    
    $keys = preg_grep( $pattern, array_keys( $input ), $flags );        
    $vals = array();
    foreach ( $keys as $key)
    {        
        $value = $input[$key];
        if($value != -1)
            $vals[$key] = $value;
    }
    return $vals;
}



addNewShift($shift_data, $dbh);

echo "New Shifts Added Successfully!";
echo "<a href='processAdminLogin.php'>click to go back </a>";
?>
