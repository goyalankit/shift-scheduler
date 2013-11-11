<?php

    	require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

	require_once(LIBRARY_PATH . "/templateFunctions.php");
        require_once(LIBRARY_PATH . "/connection_open.php");
        require_once(LIBRARY_PATH . "/entryManagement.php");

        
        
        if(isset($_POST['action']) && $_POST['action'] = 'add'){                       
            $variables = array();
            $variables = shiftsForWeek($dbh, date("W") + 1, 2013);
            renderLayoutWithContentFile("shifts.php", $variables);            
        }else{
            $variables = array();
            renderLayoutWithContentFile("shiftsIndex.php", $variables);                        
        }                                        
?>

